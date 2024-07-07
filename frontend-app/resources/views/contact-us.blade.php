<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 50px;
        }

        .contact-form {
            flex: 1;
            max-width: 600px;
        }

        .contact-form h1 {
            color: #00911e;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 36px;
        }

        .contact-form p {
            color: #555;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 18px;
            margin-bottom: 40px;
        }

        .contact-form label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 15px;
            color: #555;
            margin-bottom: 10px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid gray;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            color: #555;
        }

        .contact-form textarea {
            height: 150px;
        }

        .contact-form button {
            background-color: #00911e;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #8e51d8;
        }

        .contact-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 50px;
        }

        .contact-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')
        <div class="content">
            <div class="contact-form">
                <h1>Get in touch</h1>
                <p>We are here for you! How can we help?</p>
                <form action="{{ route('contact-us.submit') }}" method="POST">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phonenumber">Phone Number</label>
                    <input type="text" id="phonenumber" name="phonenumber" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>

                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="contact-image">
                <img src="{{ asset('images/contact-us.png') }}" alt="Contact Us">
            </div>
        </div>
        @include('footer')
    </div>
</body>

</html>
