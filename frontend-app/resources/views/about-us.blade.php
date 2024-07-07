<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TicketHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            background-color: #fff;
            padding: 20px 0;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header .nav {
            display: flex;
            gap: 20px;
        }

        .header .nav a {
            color: #000;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
        }

        .header .nav a:hover {
            color: #00911E;
        }

        .about-us {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .about-us h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #00911E;
        }

        .about-us p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .team {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .team-member {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: calc(25% - 20px);
        }

        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .team-member h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .team-member p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        @include('header')

        <div class="about-us">
            <h1>About Us</h1>
            <p>Welcome to TicketHub, your number one source for all things tickets. We're dedicated to providing you the best of event tickets, with a focus on dependability, customer service, and uniqueness.</p>
            <p>Founded in 2024 by [Your Name], TicketHub has come a long way from its beginnings. When [Your Name] first started out, [his/her/their] passion for providing the best tickets for events drove them to start their own business.</p>
            <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
            <p>Sincerely,<br>[Your Name]</p>
        </div>

        <div class="team">
            <div class="team-member">
                <img src="{{ asset('images/team-member1.jpg') }}" alt="Team Member 1">
                <h3>John Doe</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('images/team-member2.jpg') }}" alt="Team Member 2">
                <h3>Jane Smith</h3>
                <p>Chief Marketing Officer</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('images/team-member3.jpg') }}" alt="Team Member 3">
                <h3>Michael Johnson</h3>
                <p>Chief Technology Officer</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('images/team-member4.jpg') }}" alt="Team Member 4">
                <h3>Emily Davis</h3>
                <p>Head of Customer Service</p>
            </div>
        </div>

        @include('footer')
    </div>
</body>

</html>
