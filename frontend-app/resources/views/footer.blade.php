<footer>
    <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 20px; border-top: 1px solid #ccc; font-family: 'Inter', sans-serif; margin-top: 40px; margin-bottom: 70px;">
        <div>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <img src="{{ asset('images/tickethub logo.png') }}" alt="TicketHub" style="width: 99px; height: 13px; margin-right: 20px;">
                <div style="margin-left: 20px;">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin: 15px 0;"><span style="color: green;">✓</span> World class security checks</li>
                        <li style="margin: 15px 0;"><span style="color: green;">✓</span> Transparent pricing</li>
                        <li style="margin: 15px 0;"><span style="color: green;">✓</span> 100% order guarantee</li>
                        <li style="margin: 15px 0;"><span style="color: green;">✓</span> Customer service from start to finish</li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <strong style="margin-top: 15px; display: block;">Our Company</strong>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin: 15px 0;"><a href="{{ route('about-us') }}" style="color: black; text-decoration: none;">About Us</a></li>
                <!-- <li style="margin: 15px 0;"><a href="{{ route('blogs') }}" style="color: black; text-decoration: none;">Blogs</a></li>
                <li style="margin: 15px 0;"><a href="{{ route('event-organizers') }}" style="color: black; text-decoration: none;">Event Organizers</a></li> -->
            </ul>
        </div>
        <div>
            <strong style="margin-top: 15px; display: block;">Have Questions?</strong>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin: 15px 0;"><a href="{{ route('contact-us') }}" style="color: black; text-decoration: none;">Help Center / Contact Us</a></li>
            </ul>
        </div>
    </div>
</footer>
