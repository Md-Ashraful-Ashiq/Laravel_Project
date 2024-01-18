<aside id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" style="height:100vh;">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <!-- Add your sidebar items here -->
            <li class="nav-item">
                <a class="custom-button" data-toggle="collapse" href="#historySubMenu">
                    History
                </a>
                <div class="collapse" id="historySubMenu">
                    <ul class="nav flex-column pl-4">
                        <li class="nav-item">
                            <a class="custom-subbutton" href="{{ route('history') }}">
                                Activity Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="custom-subbutton">
                                Call History
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="custom-button" href="{{ route('audit-trail') }}">
                    Audit Trail
                </a>
            </li>
        </ul>
    </div>
    <script>
        // Use jQuery to handle the click event on sub-buttons
        $(document).ready(function() {
            $(".custom-subbutton").click(function(e) {
                if ($(this).closest("#historySubMenu").length) {
                    window.location.href = $(this).attr("href");
                }
            });

            // Handle the click event on the historyButton to toggle the dropdown
            $("#historyButton").click(function() {
                $("#historySubMenu").collapse("toggle");
            });
        });
    </script>
</aside>