@php
    $keywords = $pageMeta->meta_keywords ?? 'blog, affiliated , real estate news';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [['name' => 'Home', 'url' => route('home.index')], ['name' => 'Blog', 'url' => route('blog.index')]];
@endphp

<x-meta-info.meta :setup="$setup" type="CollectionPage" :title="$pageMeta->meta_title ?? 'Our Official Blog'" :description="$pageMeta->meta_description ?? 'Read the latest insights and updates from Bhaiya Housing.'" :keywords="$keywords"
    :image="$setup->meta_image ? asset('storage/' . $setup->meta_image) : $setup->logo_url ?? null" :canonical="url()->current()" :breadcrumb="$breadcrumb" />
