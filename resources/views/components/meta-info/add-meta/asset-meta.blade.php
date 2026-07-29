@php
    $keywords = $pageMeta->meta_keywords ?? 'digital assets, marketing materials, bhaiya group';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Asset Library', 'url' => route('home.filter', ['section' => 'assets'])],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="CollectionPage" :title="$pageMeta->meta_title ?? 'Digital Asset Library'" :description="$pageMeta->meta_description ?? 'Access all exclusive brand assets and housing project materials.'" :keywords="$keywords"
    :image="$pageMeta->imageUrl ?? ($setup->logo_url ?? null)" :canonical="url()->current()" :breadcrumb="$breadcrumb" />
