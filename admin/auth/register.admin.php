<?php include './admin/include/loginviews/header.php'; ?>
<div class="max-w-screen-xl m-0 sm:m-20  sm:rounded-lg flex justify-center flex-1">
    <div class="lg:w-1/2 xl:w-5/12  sm:p-12">
        <div class="flex flex-col items-center">
            <h1 class="text-2xl xl:text-3xl font-extrabold ">
                Sign up
            </h1>
            <div class="w-full flex-1 mt-6">
                <div class="mx-auto max-w-xs">
                    <form action="./index.php?pages=execution" method="post">
                        <span class="" style="color: red;"><?php check_error(); ?></span>
                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" name="username" type="text" placeholder="Username" />

                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-3" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" name="email" type="email" placeholder="Email" />

                        <select name="role_id" class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-3">
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>

                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-3" name="password" id="password" type="password" placeholder="Password" />


                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-3" name="cpassword" type="password" placeholder="Re-enter password:" />

                        <input type="submit" name="signup-admin" class="mt-3 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" value="Signup">
                        <span class="text-signup">Do have an account? <a href="./index.php?pages=login" style="text-decoration: none;">login</a></span>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
        <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat" style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');"></div>
    </div>
</div>
<?php include './admin/include/loginviews/footer.php'; ?>