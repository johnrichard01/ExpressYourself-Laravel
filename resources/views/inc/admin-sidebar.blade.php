<div class="offcanvas offcanvas-start custom-offcanvas" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title w-100 text-center" id="offcanvasScrollingLabel">MENU</h5>
        <button type="button" id="closeSide" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="button-container d-flex flex-wrap justify-content-center align-items-start align-content-start">
            <div class="row col-12 mt-5">
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard" class="text-decoration-none admin-nav btn btn-lg btn-section-active" id="homeButton">Dashboard</a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-user" class="text-decoration-none admin-nav btn btn-lg" id="usersButton">Users</a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="/dashboard/manage-admin" class="text-decoration-none admin-nav btn btn-lg" id="adminButton">Admins</a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="#" class="text-decoration-none admin-nav btn btn-lg" id="booksButton">Blogs</a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="#" class="text-decoration-none admin-nav btn btn-lg" id="orderButton">Reports</a>
                </div>
                <div class="nav-div d-flex justify-content-center mb-4">
                    <a href="#" class="text-decoration-none admin-nav btn btn-lg" id="newsButton">Newsletter</a>
                </div>
                <div class="nav-div mess-main d-flex justify-content-center">
                    <a href="#" class="text-decoration-none admin-nav btn btn-lg" id="messagesButton">Messages</a>
                    <div class="mess-counter" id="messCounter"></div>
                </div>
            </div>
        </div>
    </div>
</div>