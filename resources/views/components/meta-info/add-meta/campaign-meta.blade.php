@php
    $keywords = $pageMeta->meta_keywords ?? 'campaigns, real estate offers, bhaiya housing promotions';
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Campaigns', 'url' => route('home.filter', ['section' => 'campaigns'])],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="CollectionPage" :title="$pageMeta->meta_title ?? 'Active Campaigns & Special Offers'" :description="$pageMeta->meta_description ??
    'Stay updated with the latest housing offers, events and campaigns from Bhaiya Group.'" :keywords="$keywords"
    :image="$pageMeta->imageUrl ?? ($setup->logo_url ?? null)" :canonical="url()->current()" :breadcrumb="$breadcrumb" />
