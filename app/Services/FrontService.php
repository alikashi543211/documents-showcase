<?php

namespace App\Services;

use App\Models\Resume\ResumeBuilderSettingsModel;
use App\Models\Resume\ResumeDocumentSectionsModel;
use App\Models\Resume\ResumeGithubSectionsModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Str;

class FrontService
{

    public function __construct() {}

    public function frontServiceIndex()
    {
        if (!$this->frontServiceHelperUserLoggedIn()) {
            Session::flash('error', 'Please login to continue.');
            return redirect()->to('user-login');
        }

        // Fetch all active GitHub projects from the database
        $documents = ResumeDocumentSectionsModel::whereIsActive(1)->get();

        // Default wallpaper and profile image paths (fallbacks)

        // Fetch custom wallpaper and profile image paths from the settings table
        $settings = ResumeBuilderSettingsModel::where('key', 'LIKE', '%docs_showcase_%')->pluck('value', 'key')->toArray();

        if (isset($settings['docs_showcase_footer_copyright_text']) && !empty($settings['docs_showcase_footer_copyright_text'])) {
            $settings['docs_showcase_footer_copyright_text'] = str_replace('{current_year}', date('Y'), $settings['docs_showcase_footer_copyright_text']);
        }

        if (isset($settings['docs_showcase_wallpaper_image_path']) && !empty($settings['docs_showcase_wallpaper_image_path'])) {
            $settings['docs_showcase_wallpaper_image_path'] = env('RESUME_BASE_MEDIA_URL') . $settings['docs_showcase_wallpaper_image_path'];
        }
        if (isset($settings['docs_showcase_profile_image_path']) && !empty($settings['docs_showcase_profile_image_path'])) {
            $settings['docs_showcase_profile_image_path'] = env('RESUME_BASE_MEDIA_URL') . $settings['docs_showcase_profile_image_path'];
        }
        // Return the front.index view with all defined variables in the current scope
        return view('front.index', get_defined_vars());
    }

    public function downloadDocuments($request)
    {
        if (!$this->frontServiceHelperUserLoggedIn()) {
            Session::flash('error', 'Please login to continue.');
            return redirect()->to('user-login');
        }
        try {
            $documentIds = explode(',', $request->input('ids'));
            $documents = ResumeDocumentSectionsModel::whereIn('id', $documentIds)->get();

            if ($documents->isEmpty()) {
                return response()->json(['error' => 'No documents found.'], 404);
            }

            if (count($documents) == 1) {
                $doc = $documents->first();
                $extension = pathinfo($doc->document_path, PATHINFO_EXTENSION);
                $fileName = ($doc->document_title ?? Str::random(10)) . '.' . $extension;
                return response()->download($doc->document_path, $fileName, [
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma'        => 'no-cache',
                    'Expires'       => '0',
                ]);
            }

            // Create temporary zip file
            $zipFileName = 'kashif_docs_' . time() . '.zip';
            $zipFilePath = storage_path('app/public/' . $zipFileName);

            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                foreach ($documents as $doc) {
                    // Assuming $doc->file_path contains the file's relative path (e.g., 'documents/sample.pdf')
                    $filePath = $doc->document_path;
                    if (file_exists($filePath)) {
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        $fileName = ($doc->document_title ?? Str::random(10)) . '.' . $extension;
                        $zip->addFile($filePath, $fileName);
                    }
                }
                $zip->close();

                // Return the zip file as a download response
                return response()->download($zipFilePath, $zipFileName, [
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma'        => 'no-cache',
                    'Expires'       => '0',
                ])->deleteFileAfterSend(true);
            } else {
                return response()->json(['error' => 'Could not create zip file.'], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to download documents.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function frontServiceUserLoginView()
    {
        if ($this->frontServiceHelperUserLoggedIn()) {
            return redirect()->to('/');
        }

        // Fetch all active GitHub projects from the database
        $documents = ResumeDocumentSectionsModel::whereIsActive(1)->get();

        // Default wallpaper and profile image paths (fallbacks)

        // Fetch custom wallpaper and profile image paths from the settings table
        $settings = ResumeBuilderSettingsModel::where('key', 'LIKE', '%docs_showcase_%')->pluck('value', 'key')->toArray();


        if (isset($settings['docs_showcase_profile_image_path']) && !empty($settings['docs_showcase_profile_image_path'])) {
            $settings['docs_showcase_profile_image_path'] = env('RESUME_BASE_MEDIA_URL') . $settings['docs_showcase_profile_image_path'];
        }
        return view('front.user_login', get_defined_vars());
    }

    public function frontServiceUserLogin($request)
    {

        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'username' => 'required|max:250',
            'password' => 'required|min:8|max:20',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->to('/user-login');
        }
        $inputs['username'] = strtolower($inputs['username']);
        // Fetch custom wallpaper and profile image paths from the settings table
        $settings = ResumeBuilderSettingsModel::where('key', 'LIKE', '%docs_showcase_%')->pluck('value', 'key')->toArray();
        $username = $settings['docs_showcase_login_username'] ?? 'kashif.ali';
        $password = $settings['docs_showcase_login_password'] ?? '12345678';
        if ($inputs['username'] == $username && $inputs['password'] == $password) {
            Session::put('user_logged_in', [
                'username' => $inputs['username'],
                'password' => $inputs['password'],
                'expires_at' => Carbon::now()->addMinutes($settings['docs_showcase_logout_in_minutes'] ?? 5)->timestamp
            ]);

            Session::flash('success', "You Logged in Successfully.");
            return redirect()->to('/');
        }

        Session::flash('error', 'Invalid email or password.');
        return redirect()->to('/user-login');
    }

    public function frontServiceUserLogout()
    {

        Session::forget('user_logged_in');
        Session::flash('success', 'Logged out successfully.');
        return redirect()->to('/user-login');
    }

    public function frontServiceHelperUserLoggedIn()
    {
        $settings = ResumeBuilderSettingsModel::where('key', 'LIKE', '%docs_showcase_%')->pluck('value', 'key')->toArray();
        $username = $settings['docs_showcase_login_username'] ?? 'kashif.ali';
        $password = $settings['docs_showcase_login_password'] ?? '12345678';

        if (Session::has('user_logged_in')) {
            $userSession = Session::get('user_logged_in');
            if ($userSession && isset($userSession['expires_at']) && time() < $userSession['expires_at']) {
                $username = $userSession['username'];
                $password = $userSession['password'];

                if ($userSession['username'] == $username && $userSession['password'] == $password) {
                    return true;
                }
            } else {
                // Session expired or invalid
                Session::forget('user_logged_in');
            }
        }

        return false;
    }
}
