<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blogs;
use App\Models\Comment;
use DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
        //showing homepage
    public function index(){
        $latestBlog = Blogs::latest()->first();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if ($latestBlog) {
            $blogs = Blogs::where('id', '!=', $latestBlog->id)->latest()->simplePaginate(4);
        } else if (!$latestBlog) {
            $blogs = Blogs::latest()->simplePaginate(4);
        }
        $user = Auth::user();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('user.home', compact('blogs','latestBlog', 'user','populars'));
                }
            } 
        }
        else
        {
            return view('homepage.index', compact('blogs','latestBlog', 'user','populars'));
        }
    }
    //showing category
    public function show_artwork(){
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('categories.artwork',[

                        'blogs'=>Blogs::where('category', 'artwork')->latest()->simplePaginate(6),
                        'user'=>$user,
                        'populars'=>$populars
                    ]);
                }
            } 
        }
        else
        {
            return view('categories.artwork',[
                
                'blogs'=>Blogs::where('category', 'artwork')->latest()->simplePaginate(6),
                'user'=>$user,
                'populars'=>$populars
            ]);
        }
    }
    //showing category
    public function show_craft(){
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('categories.craft',[

                        'blogs'=>Blogs::where('category', 'craft')->latest()->simplePaginate(6),
                        'user'=>$user,
                        'populars'=>$populars
                    ]);
                }
            } 
        }
        else
        {
            return view('categories.craft',[
                
                'blogs'=>Blogs::where('category', 'craft')->latest()->simplePaginate(6),
                'user'=>$user,
                'populars'=>$populars
            ]);
        }
    }
    //showing category
    public function show_literature(){
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('categories.literature',[

                        'blogs'=>Blogs::where('category', 'literature')->latest()->simplePaginate(6),
                        'user'=>$user,
                        'populars'=>$populars
                    ]);
                }
            } 
        }
        else
        {
            return view('categories.literature',[
                
                'blogs'=>Blogs::where('category', 'literature')->latest()->simplePaginate(6),
                'user'=>$user,
                'populars'=>$populars
            ]);
        }
    }
    //showing category
    public function show_photography(){
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('categories.photography',[

                        'blogs'=>Blogs::where('category', 'photography')->latest()->simplePaginate(6),
                        'user'=>$user,
                        'populars'=>$populars
                    ]);
                }
            } 
        }
        else
        {
            return view('categories.photography',[
                
                'blogs'=>Blogs::where('category', 'photography')->latest()->simplePaginate(6),
                'user'=>$user,
                'populars'=>$populars
            ]);
        }
    }
    //serach function
    public function search(){
        $search = request('search');
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('categories.search',[
                        'search'=>ucfirst($search),
                        'blogs'=>Blogs::latest()->filter(request(['category','search']))->simplePaginate(6),
                        'user'=>$user,
                        'populars'=>$populars
                    ]);
                }
            } 
        }
        else
        {
            return view('categories.search',[
                'search'=>ucfirst($search),
                'blogs'=>Blogs::latest()->filter(request(['category','search']))->simplePaginate(6),
                'user'=>$user,
                'populars'=>$populars
            ]);
        }
    }


    
    //show single blogs
    public function show(Blogs $blog)
    {
        $author = $blog->user;
        $user = Auth::user();
        $populars = Blogs::withCount('comments')->orderByDesc('comments_count')->limit(5)->get();
        // Load comments associated with the blog post, including the user relationship
        $comments = Comment::with('user')->where('blog_id', $blog->id)->latest()->get();

        if (Auth::check()) 
        {
            if ($user->email_verified_at == null) 
            {
                return redirect('/email/verify');
            }
             else if ($user->email_verified_at != null) 
            {
                if (Auth::user()->role_as == '1') 
                {
                    return redirect('/dashboard');
                } 
                 else if (Auth::user()->role_as == '0') 
                {
                    return view('homepage.show', [
                        'blog' => $blog,
                        'user' => $user,
                        'author' => $author,
                        'comments' => $comments,
                        'populars'=>$populars
                    ]);
                }
            }
        } 
        else if (!Auth::check()) 
        {
            return view('homepage.show', [
                'blog' => $blog,
                'user' => $user,
                'author' => $author,
                'comments' => $comments,
                'populars'=>$populars
            ]);
        }
    }



    //show create blogs form
    public function create()
    {
        $user = Auth::user();
        return view('user.create', compact('user'));
    }
    public function store(Request $request)
    {
        $post=$request->validate([
            'title'=> 'required',
            'category'=> ['required', 'not_in:0'],
            'content'=>'required',
            'about'=>'required'
        ]);
        $content= $request->content;
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom = new \DomDocument();
        
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
 
        $imageFile = $dom->getElementsByTagName('imageFile');
  
        foreach($imageFile as $item => $image)
        {

            $data = $image->getAttribute('src');
 
            list($type, $data) = explode(';', $data);
 
            list(, $data)      = explode(',', $data);
 
            $imgeData = base64_decode($data);
 
            $image_name= "/upload/" . time().$item.'.png';
 
            $path = public_path() . $image_name;
 
            file_put_contents($path, $imgeData);
            
            $image->removeAttribute('src');
 
            $image->setAttribute('src', $image_name);
         }
        if($request->hasFile('thumbnail')){
            $post['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        $post['user_id']= auth()->id();
        $content = $dom->saveHTML();
        $post['content'] = $content;
        Blogs::create($post);
        return redirect('/')->with('success', 'Successfully created a blog');
    }


    public function show_update(Blogs $blogs)
    {
        $user= Auth::user();
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('user.update', [
                    'user'=>$user,
                    'blogs'=>$blogs
                ]);
            }
        }
        else
        {
            return view('user.update', [
                'user'=>$user,
                'blogs'=>$blogs
            ]);
        }
    }


    public function update(Request $request, Blogs $blogs)
    {
        if($blogs->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        $post=$request->validate([
            'title'=> 'required',
            'category'=> ['required', 'not_in:0'],
            'content'=>'required',
            'about'=>'required'
        ]);
        $content= $post['content'];
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom = new DOMDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
 
        $imageFile = $dom->getElementsByTagName('imageFile');
  
        foreach($imageFile as $item => $image)
        {

            $data = $image->getAttribute('src');
 
            list($type, $data) = explode(';', $data);
 
            list(, $data)      = explode(',', $data);
 
            $imgeData = base64_decode($data);
 
            $image_name= "/upload/" . time().$item.'.png';
 
            $path = public_path() . $image_name;
 
            file_put_contents($path, $imgeData);
            
            $image->removeAttribute('src');
 
            $image->setAttribute('src', $image_name);
         }
        if($request->hasFile('thumbnail')){
            $post['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        $post['user_id']= auth()->id();
        $content = $dom->saveHTML();
        $post['content'] = $content;
        $blogs->update($post);
        return redirect('/myblogs')->with('success', 'Changes saved');
    }



    public function destroy( Request $request)
    {
        $blogs= Blogs::find($request->user_delete_id);
        if($blogs->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        $blogs->delete();
        return redirect('/myblogs')->with('success', 'Blog has been deleted');
    }



    public function show_myblogs()
    {
        $blogs = auth()->user()->blogs()->get();
        $user = Auth::user();
        if(Auth::check())
        {
            if(Auth::user()->role_as == '1')
            {
                return redirect('/dashboard');
            }
            else if(Auth::user()->role_as == '0')
            {
                return view('user.myblogs', compact('blogs', 'user',));
            }
        }
        else
        {
            return view('user.myblogs', compact('blogs', 'user',));
        }
    }

//BOOKMARK SYSTEM
    public function bookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->create([
            'blog_id' => $blog->id,
        ]);
    
        return redirect()->back()->with('success', 'Post bookmarked successfully!');
    }
    
    public function unbookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->where('blog_id', $blog->id)->delete();
    
        return redirect()->back()->with('success', 'Post bookmarked successfully!');
    }

}
