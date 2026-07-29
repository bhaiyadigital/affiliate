@php
    $keywords = $campaign->meta_keywords;
    if (is_array($keywords)) {
        $keywords = implode(', ', $keywords);
    }

    $breadcrumb = [
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Campaigns', 'url' => route('home.filter', ['section' => 'campaigns'])],
        ['name' => $campaign->title, 'url' => url()->current()],
    ];
@endphp

<x-meta-info.meta :setup="$setup" type="Article" :title="($campaign->meta_title ?: $campaign->title) . ' | ' . ($setup->site_name ?? 'Affiliate')" :description="$campaign->meta_description ?: Str::limit(strip_tags($campaign->description), 160)" :keywords="$keywords ?: $campaign->title . ', offer, bhaiya housing'"
    :image="$campaign->thumbnailUrl ?: $setup->logo_url ?? asset('images/header/logo.png')" :canonical="url()->current()" :breadcrumb="$breadcrumb" :schema="[
        'headline' => $campaign->title,
        'published' => $campaign->published_at,
        'updated' => $campaign->updated_at,
    ]" />
