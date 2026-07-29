@php
    $keywords = $project->meta_keywords;
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Projects', 'url' => route('affiliated.project')],
        ['name' => $project->title, 'url' => url()->current()],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="RealEstateListing" :title="($project->meta_title ?: $project->title) . ' | ' . ($setup->site_name ?? 'Affiliate')" :description="$project->meta_description ?: Str::limit(strip_tags($project->description), 160)" :keywords="$keywords ?: $project->title . ', real estate project, bhaiya housing'"
    :image="$project->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png')" :canonical="url()->current()" :breadcrumb="$breadcrumb" :schema="[
        'headline' => $project->title,
        'published' => $project->created_at,
        'updated' => $project->updated_at,
    ]" />
