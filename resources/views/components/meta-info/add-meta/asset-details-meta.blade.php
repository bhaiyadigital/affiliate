@php
    $keywords = $asset->meta_keywords;
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Asset Library', 'url' => route('home.filter', ['section' => 'assets'])],
        ['name' => $asset->title, 'url' => url()->current()],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="ItemPage" :title="($asset->meta_title ?: $asset->title) . ' | ' . ($setup->site_name ?? 'Affiliate')" :description="$asset->meta_description ?: Str::limit(strip_tags($asset->description), 160)" :keywords="$keywords ?: $asset->title . ', download, bhaiya housing assets'"
    :image="$asset->imageUrl ?: $setup->logo_url ?? asset('images/header/logo.png')" :canonical="url()->current()" :breadcrumb="$breadcrumb" :schema="[
        'headline' => $asset->title,
        'published' => $asset->created_at,
        'updated' => $asset->updated_at,
    ]" />
