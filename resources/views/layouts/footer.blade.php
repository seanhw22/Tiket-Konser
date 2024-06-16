<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>ConcertTickets</h3>
                <p>Your go-to platform for discovering and booking tickets to the hottest concerts and events.</p>
            </div>
            <div class="col-md-6">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('event')}}">Events</a></li>
                    <li><a href="{{route('about')}}">About Us</a></li>
                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
    const footer = document.getElementById('footer');

    window.addEventListener('DOMContentLoaded', function() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var documentHeight = document.documentElement.offsetHeight;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var isScrollable = (documentHeight - scrollTop) > windowHeight;

        if (isScrollable) {
            footer.classList.remove('fixed-bottom');
        } else {
            footer.classList.add('fixed-bottom');
        }
    });
</script>