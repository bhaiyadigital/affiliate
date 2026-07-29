@php
    $keywords = $pageMeta->meta_keywords ?? 'housing projects, bhaiya group, real estate dhaka';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Projects', 'url' => route('affiliated.project')],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="CollectionPage" :title="$pageMeta->meta_title ?? 'Our Exclusive Projects'" :description="$pageMeta->meta_description ?? 'Explore premium housing and real estate projects by Bhaiya Group.'" :keywords="$keywords"
    :image="$pageMeta->imageUrl ?? ($setup->logo_url ?? null)" :canonical="url()->current()" :breadcrumb="$breadcrumb" />
