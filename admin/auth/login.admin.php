<?php include './admin/include/loginviews/header.php'; ?>
<div class="max-w-screen-xl m-0 sm:m-20   sm:rounded-lg flex justify-center flex-1">
    <div class="lg:w-1/2 xl:w-5/12  sm:p-12">
        <div class="flex flex-col items-center">
            <h1 class="text-2xl xl:text-3xl font-extrabold ">
                Login
            </h1>
            <div class="w-full flex-1 mt-6">
                <div class="mx-auto max-w-xs">
                    <form action="./index.php?pages=execution" method="post">
                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" name="email" type="email" placeholder="Email" />
                        <input class="w-full px-8 py-3 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-3" name="password" type="password" placeholder="Password" />
                        <input type="submit" name="login-admin" class="mt-4 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" value="Login">
                        <span class="text-signup">Don't have an account? <a href="./index.php?pages=register" style="text-decoration: none;">signup</a></span>
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