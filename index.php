Q1:
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }
}


Q2:
Route::get('/home', function () {
    return redirect('/dashboard', 302);
});


Q3:
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info('Request Method: ' . $request->method());
        Log::info('Request URL: ' . $request->fullUrl());

        return $next($request);
    }
}
protected $middleware = [
    // Other middleware...
    \App\Http\Middleware\LogRequestMiddleware::class,
];

Q4:
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        // Logic for the profile route
    });

    Route::get('/settings', function () {
        // Logic for the settings route
    });
});

Q5:
php artisan make:controller ProductController --resource --model=Product
<?php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Add more validation rules as needed
        ]);

        // Create a new product with the validated data
        $product = Product::create($validatedData);

        // Redirect to the product's show page or any other desired page
        return redirect()->route('products.show', $product->id);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Add more validation rules as needed
        ]);

        // Update the product with the validated data
        $product->update($validatedData);

        // Redirect to the product's show page or any other desired page
        return redirect()->route('products.show', $product->id);
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect to the index page or any other desired page
        return redirect()->route('products.index');
    }
}
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);


Q6:
php artisan make:controller ContactController --invokable
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send an email with the submitted data
        Mail::send([], [], function ($message) use ($validatedData) {
            $message->to('your-email@example.com')
                ->subject('New Contact Form Submission')
                ->setBody("
                    Name: {$validatedData['name']}
                    Email: {$validatedData['email']}
                    Message: {$validatedData['message']}
                ");
        });

        // Redirect back or to a thank you page
        return redirect()->back()->with('success', 'Thank you for your message!');
    }
}
use App\Http\Controllers\ContactController;

Route::post('/contact', ContactController::class);

Q7: 
php artisan make:controller PostController --resource --model=Post
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Logic to retrieve all posts
        $posts = Post::all();

        // Return a view with the posts data
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Return the view for creating a new post
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            // Add more validation rules as needed
        ]);

        // Create a new post with the validated data
        $post = Post::create($validatedData);

        // Redirect to the post's show page or any other desired page
        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Return a view with the post data
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Return the view for editing the post
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            // Add more validation rules as needed
        ]);

        // Update the post with the validated data
        $post->update($validatedData);

        // Redirect to the post's show page or any other desired page
        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Delete the post
        $post->delete();

        // Redirect to the index page or any other desired page
        return redirect()->route('posts.index');
    }
}
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);
Q8:
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Laravel</title>
</head>
<body>
    <nav>
        <!-- Add your navigation bar code here -->
        <!-- Example: -->
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </nav>

    <section>
        <!-- Add the section to display the "Welcome to Laravel!" text -->
        <h1>Welcome to Laravel!</h1>
    </section>
</body>
</html>


