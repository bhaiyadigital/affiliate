@php
    $keywords = $pageMeta->meta_keywords ?? ($setup->meta_keywords ?? '');
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }
@endphp

<x-meta-info.meta
    :setup="$setup"
    type="WebPage"
    :title="$pageMeta->meta_title ?? ($setup->meta_title ?? ($setup->site_name ?? 'Bhaiya Housing'))"

    :description="$pageMeta->meta_description ?? ($setup->meta_description ?? 'Explore exclusive brand assets and real estate marketing materials.')"

    :keywords="$keywords"

    :image="$pageMeta->imageUrl ?? ($setup->meta_image ? asset('storage/'.$setup->meta_image) : ($setup->logo_url ?? null))"

    :canonical="url()->current()"

    :breadcrumb="[
        [
            'name' => 'Home',
            'url'  => url('/')
        ]
    ]"
/>
