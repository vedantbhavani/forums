
<!-- Modal -->
<div class="modal fade" id="logoutModal" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="logoutModalLabel">Are sure want to Logout!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forums/partials/handlelogout.php" method="post">
                    <label for="signupEmail" id="logout-line1" class="form-label">Have a great day ahead!</label>
                    <label for="signupEmail" id="logout-line2" class="form-label">See you next time😊</label>
                    <div>
                        <button type="submit" class="btn btn-primary">Logout</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>