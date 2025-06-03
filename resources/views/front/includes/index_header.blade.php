<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Documents | KashifTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom right, #fff8f0, #fef6e4);
            color: #2f2f2f;
        }

        #popupAlert {
            position: fixed;
            top: 0px;
            right: 0px;
            z-index: 1080;
            min-width: 250px;
        }

        .popupAlert-success {
            background: green;
            color: white;
        }

        .popupAlert-danger {
            background: red;
            color: white;
        }

        .profile-banner {
            background-image: url("https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1400&q=80");
            background-size: cover;
            background-position: center;
            height: 200px;
            border-radius: 0.5rem;
            position: relative;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 4px solid #fff;
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 50%;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .document-card {
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .document-card:hover {
            border-color: #43aa8b;
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .document-card input[type="checkbox"] {
            display: none;
        }

        .document-card.selected {
            border-color: #277d70;
            background-color: #e6f6f1;
        }

        .download-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            display: none;
            box-shadow: 0 6px 20px rgba(67, 170, 139, 0.4);
        }

        h6 {
            font-weight: 600;
            color: #2f2f2f;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
</head>
