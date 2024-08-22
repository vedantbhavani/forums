
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModalLabel">Signup to Forum</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forums/partials/handlesignup.php" method="post">
                    <div class="mb-3">
                        <label for="signupName" class="form-label">Username</label>
                        <input type="text" maxlength="15" name="signupName" class="bg-secondary-subtle form-control" id="signupName" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email</label>
                        <input type="email" name="signupEmail" class="bg-secondary-subtle form-control" id="signupEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input type="password" name="signupPassword" class="bg-secondary-subtle form-control" id="signupPassword" required>
                    </div>
                    <div class="mb-3">
                    <label for="signupcPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="signupcPassword" class="bg-secondary-subtle form-control" id="signupcPassword" required>
                        <div class="form-text">Sure to same as your password</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
        </div>
    </div>
</div>
