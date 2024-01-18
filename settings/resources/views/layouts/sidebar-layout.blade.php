<aside id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" style="height:100vh;">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <!-- Add your sidebar items here -->
            <li class="nav-item">
                <a class="custom-button" href="{{ route('permission') }}">
                    Permission
                </a>
            </li>
            <li class="nav-item">
                <a id="audit-button" class="custom-button" href="{{ route('audit-trail') }}">
                    Audit Trail
                </a>
            </li>
            <li class="nav-item">
                    <a id="users-button" class="custom-button" href="{{ route('users') }}">
                       Users
                    </a>
            </li>
            <li class="nav-item">
                    <a id="operation-management-button" class="custom-button" href="{{ route('operation-management') }}">
                        Operation Management
                    </a>
            </li>
        </ul>
    </div>
</aside>