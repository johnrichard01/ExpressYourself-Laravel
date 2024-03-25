<div class="offcanvas offcanvas-start custom-offcanvas" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title w-100 text-center" id="offcanvasScrollingLabel">MENU</h5>
        <button type="button" id="closeSide" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="button-container d-flex flex-wrap justify-content-center align-items-start align-content-start">
            <div class="row col-12 mt-5">
                <div class="mb-5 profile-container-side">
                    <div class="dropdown-side d-flex flex-wrap justify-content-center justify-content-lg-end              align-items-center">
                        <a href="#" type="button" class="dropdown-toggle dropdown-profile" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{$currentUser->avatar ? asset('storage/app/public/' . $currentUser->avatar) : asset('assets/images/noprofile.png')}}" alt="Profile Picture" class="profile-icon img-fluid rounded-circle">
                        </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="nav-link text-center" href="/dashboard/profile">
                                        Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="/dashboard/change-password">
                                        Change passowrd
                                    </a>
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                            <button type="submit" class="dropdown-item text-center" id="logout">
                                                Logout
                                            </button>
                                        </form>
                                </li>
                            </ul>
                    </div>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard" class="text-decoration-none admin-nav btn btn-lg {{ request()->is('dashboard') ? 'home-active' : '' }}" id="homeButton">
                        <span class="sidebar-text">Dashboard</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-user" class="text-decoration-none admin-nav btn btn-lg {{ request()->is('dashboard/manage-user') ? 'home-active' : '' }}" id="usersButton">
                        <span class="sidebar-text">Users</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem   " fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-admin" class="text-decoration-none admin-nav btn btn-lg {{ request()->is('dashboard/manage-admin') ? 'home-active' : '' }}" id="adminButton">
                        <span class="sidebar-text">Admins</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-blogs" class="text-decoration-none admin-nav btn btn-lg {{ request()->is('dashboard/manage-blogs') ? 'home-active' : '' }}" id="booksButton">
                        <span class="sidebar-text">Blogs</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-reports" class="text-decoration-none admin-nav btn btn-lg  {{ request()->is('dashboard/manage-reports') ? 'home-active' : '' }}" id="orderButton">
                        <span class="sidebar-text">Reports</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-subscriber" class="text-decoration-none admin-nav btn btn-lg  {{ request()->is('dashboard/manage-subscriber') ? 'home-active' : '' }}" id="newsButton">
                        <span class="sidebar-text">Newsletter</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                              </svg>
                        </span>
                    </a>
                </div>
                <div class="nav-div mess-main d-flex justify-content-center">
                    <a href="/dashboard/manage-messages" class="text-decoration-none admin-nav btn btn-lg {{ request()->is('dashboard/manage-messages') ? 'home-active' : '' }}" id="messagesButton">
                        <span class="sidebar-text">Messages</span>
                        <span class="sidebar-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z"/>
                              </svg>
                        </span>
                    </a>
                    @if ($unreadCount == 0)
                    @else
                        <div class="mess-counter" id="messCounter">{{$unreadCount}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>