<?php
try {
    $url = 'http://localhost:8085/api/NguoiDung/GetNguoiDung';
    $data = file_get_contents($url);
    if ($data !== false) {
        $result = json_decode($data, true);

        foreach ($result as $nguoiDung) {
            echo '
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-sign-in"
                    role="tabpanel" aria-labelledby="nav-sign-in-tab">
                    <div class="form-group py-3">
                        <label class="mb-2" for="sign-in">Username or email
                            address *</label>
                        <input type="text" minlength="2" name="username"
                            placeholder="Your Username"
                            class="form-control w-100 rounded-3 p-3"
                            value="' . $nguoiDung['tenDangNhap'] . '"
                            required>
                    </div>
                    <div class="form-group pb-3">
                        <label class="mb-2" for="sign-in">Password *</label>
                        <input type="password" minlength="2" name="password"
                            placeholder="Your Password"
                            class="form-control w-100 rounded-3 p-3"
                            required>
                    </div>
                    <label class="py-3">
                        <input type="checkbox" required="" class="d-inline">
                        <span class="label-body">Remember me</span>
                        <span class="label-body"><a href="#"
                                class="fw-bold">Forgot Password</a></span>
                    </label>
                    <button type="submit" name="submit"
                        class="btn btn-dark w-100 my-3">Login</button>
                </div>
                <div class="tab-pane fade" id="nav-register" role="tabpanel"
                    aria-labelledby="nav-register-tab">
                    <div class="form-group py-3">
                        <label class="mb-2" for="register">Your email
                            address *</label>
                        <input type="text" minlength="2" name="username"
                            placeholder="Your Email Address"
                            class="form-control w-100 rounded-3 p-3"
                            value="' . $nguoiDung['email'] . '"
                            required>
                    </div>
                    <div class="form-group pb-3">
                        <label class="mb-2" for="sign-in">Password *</label>
                        <input type="password" minlength="2" name="password"
                            placeholder="Your Password"
                            class="form-control w-100 rounded-3 p-3"
                            required>
                    </div>
                    <label class="py-3">
                        <input type="checkbox" required="" class="d-inline">
                        <span class="label-body">I agree to the <a href="#"
                                class="fw-bold">Privacy
                                Policy</a></span>
                    </label>
                    <button type="submit" name="submit"
                        class="btn btn-dark w-100 my-3">Register</button>
                </div>
            </div>';
        }

    }
} catch (PDOException $err) {
    echo "<script>console.log('FAILED. Error: $err' );</script><br><br>";
}
?>