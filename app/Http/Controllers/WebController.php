<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\EventRegistration;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;


class WebController extends Controller
{


    // $all   = $this->fetchContent('slider'); get all
    // $whos      = $this->fetchContent('who-we-are', 3); take() limit
    // Fetch only defined fields from AppServiceProvider
    private function getFields($module)
    {
        // Get globally shared contents array
        $modules = view()->shared('modules');

        // If type doesn't exist, fallback to all fields
        if (!isset($modules[$module])) {
            return ['id', 'module', 'title', 'slug', 'img_path', 'short', 'status', 'created_at'];
        }



        $fields = array_keys($modules[$module]);
        $fields[] = 'id';
        $fields[] = 'module'; // type -> module
        $fields[] = 'slug';   // name -> slug
        return array_unique($fields);
    }


    // Reusable content fetcher
    private function fetchContent($module, $limit = null, $slug = null, $paginate = null)
    {
        $query = Content::select($this->getFields($module))
            ->where('module', $module) // type -> module
            ->where('status', '1');

        if ($slug) {
            $query->where('slug', $slug); // name -> slug
        }

        $query->orderBy('created_at', 'desc');

        if ($paginate) {
            return $query->paginate($paginate);
        }

        if ($limit == 1) {
            return $query->first();
        } elseif ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    public function index()
    {
        $hero      = $this->fetchContent('hero', 1);
    }

    public function project(Request $request)
    {
        $pageMeta = Content::where('module', 'pages')->where('slug', 'projects')->first();
        $query = Content::where('module', 'project')->where('status', 1);

        if ($request->filled('cat')) {
            $query->where('parent_id', $request->cat);
        }
        if ($request->filled('dest')) {
            $query->where('destination_id', $request->dest);
        }

        $projects = $query->orderBy('sort_order', 'asc')->paginate(6);

        $categories = Content::where('module', 'concern')->where('status', 1)->get();
        $destinations = Content::where('module', 'destination')->where('status', 1)->get();

        return view('frontend.landing.projectList', compact('projects', 'categories', 'destinations', 'pageMeta'));
    }

    public function details(Request $request, $slug)
    {
        $project = Content::where('module', 'project')
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();
        if ($request->has('ref')) {
            cookie()->queue('referred_by', $request->query('ref'), 60 * 24 * 30);
        }
        if (!$project) {
            $oldProject = Content::where('module', 'project')
                ->where('prev_slug', $slug)
                ->where('status', 1)
                ->first();

            if ($oldProject) {
                return redirect()->route('project.details', $oldProject->slug, 301);
            }
            abort(404);
        }

        $allFeatures = Content::where('module', 'project_glance')
            ->where('parent_id', $project->id)
            ->where('status', 1)
            ->get();

        $project->increment('views');

        $relatedProjects = Content::where('module', 'project')
            ->where('id', '!=', $project->id)
            ->where('parent_id', $project->parent_id)
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        if ($relatedProjects->isEmpty()) {
            $relatedProjects = Content::where('module', 'project')
                ->where('id', '!=', $project->id)
                ->where('status', 1)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('frontend.landing.projectDetails', compact('project', 'relatedProjects', 'allFeatures'));
    }
    public function check(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);
        \Log::info($request);
        $code = strtoupper(trim($request->coupon_code));

        $coupon = Content::where('module', 'coupons')
            ->where('slug', $code)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json(['valid' => false]);
        }

    

        return response()->json([
            'valid'    => true,
            'discount' => $coupon->short,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'category_id' => 'nullable|exists:contents,id',
            'message' => 'nullable|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'category_id' => $request->category_id,
            'message' => $request->message,
            'phone_code' => '+880',
        ]);

        return back()->with('success', 'Thank you! Your interest has been submitted successfully.');
    }

    public function blog()
    {
        $pageMeta = Content::where('module', 'pages')->where('slug', 'blogs')->first();

        $blogs = Content::where('module', 'blogs') // type -> module
            ->where('status', 1)
            ->latest()
            ->paginate(6);

        return view('frontend.blog.index', compact('blogs', 'pageMeta'));
    }

    public function blogDetails($slug)
    {
        // type -> module, name -> slug
        $blog = Content::where('module', 'blogs')->where('slug', $slug)->where('status', 1)->firstOrFail();

        $relatedBlogs = Content::where('module', 'blogs') // type -> module
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.blog.details', compact('blog', 'relatedBlogs'));
    }
}
