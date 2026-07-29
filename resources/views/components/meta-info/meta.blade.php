@props([
    'setup',
    'type' => 'WebPage',
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'canonical' => null,
    'breadcrumb' => [],
    'schema' => [],
    'faq' => [],
    'socialLinks' => [],
])

@php
    $siteName = $setup->site_name ?? 'Bhaiya Housing';
    $titleText = $title ?: $setup->meta_title ?? $siteName;
    $finalTitle = $titleText . ' | ' . ($setup->site_name ?? 'Affiliate');

    $description = $description ?: $setup->meta_description ?? '';
    $keywords = is_array($keywords) ? implode(',', $keywords) : ($keywords ?: $setup->meta_keywords ?? '');
    $canonical = $canonical ?: url()->current();

    if (!$image) {
        if (!empty($setup->meta_image)) {
            $image = asset('storage/' . $setup->meta_image);
        } elseif (!empty($setup->logo)) {
            $image = $setup->logo_url ?? asset('storage/' . $setup->logo);
        } else {
            $image = asset('images/header/logo.png');
        }
    }

    $socials = [];
    if (!empty($setup->social_links)) {
        $links = is_array($setup->social_links) ? $setup->social_links : json_decode($setup->social_links, true);
        if (is_array($links)) {
            foreach ($links as $link) {
                $url = is_array($link) ? $link['url'] ?? $link : $link;
                if (!empty($url)) {
                    $socials[] = $url;
                }
            }
        }
    }

    $organizationLogo = !empty($setup->logo) ? $setup->logo_url ?? asset('storage/' . $setup->logo) : $image;
@endphp

<title>{{ $finalTitle }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="{{ $finalTitle }}">
<meta name="description" content="{{ $description }}">
@if ($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="author" content="{{ $siteName }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $type == 'BlogPosting' ? 'article' : 'website' }}">
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="{{ $siteName }}">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $finalTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

{{-- Organization --}}
<script type="application/ld+json">
{!! json_encode([
    '@context'=>'https://schema.org',
    '@type'=>'Organization',
    'name' => $siteName,
    'url' => url('/'),
    'logo' => $organizationLogo,
    'email' => $setup->email ?? '',
    'telephone' => $setup->phone ?? '',
    'foundingDate'=>$setup->established,
    'sameAs' => $socials,
    'founder'=>[
        '@type'=>'Person',
        'name'=>$setup->founder_name,
        'jobTitle'=>$setup->founder_designation
    ],
    'address'=>[
        '@type' => 'PostalAddress',
        'streetAddress' => $setup->address ?? '',
        'addressCountry' => 'BD'
    ]
],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>

{{-- Website --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $siteName,
    'url' => url('/')
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

{{-- WebPage --}}
<script type="application/ld+json">
{!! json_encode([
    '@context'=>'https://schema.org',
    '@type'=>'WebPage',
    'name'=>$title,
    'description'=>$description,
    'url'=>$canonical,
    'primaryImageOfPage'=>$image
],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>

{{-- Breadcrumb --}}
@if (count($breadcrumb))
    <script type="application/ld+json">
{!! json_encode([
    '@context'=>'https://schema.org',
    '@type'=>'BreadcrumbList',
    'itemListElement'=>collect($breadcrumb)->values()->map(function($item,$index){

        return [
            '@type'=>'ListItem',
            'position'=>$index+1,
            'name'=>$item['name'],
            'item'=>$item['url']
        ];

    })->toArray()
],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
</script>
@endif


{{-- BlogPosting --}}
@if ($type == 'BlogPosting')
    <script type="application/ld+json">
{!! json_encode([
    '@context'=>'https://schema.org',
    '@type'=>'BlogPosting',
    'headline' => $schema['headline'] ?? $finalTitle,
    'description' => $description,
    'image' => $image,
    'author' => ['@type' => 'Organization', 'name' => $siteName],
    'datePublished' => $schema['published'] ?? now()->toIso8601String(),

],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) !!}
</script>
@endif


{{-- 5. FAQ --}}
@if ($type == 'FAQPage' && count($faq))
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => collect($faq)->map(function ($item) {
        return [
            '@type' => 'Question',
            'name' => $item['question'] ?? ($item['title'] ?? ''),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => strip_tags($item['answer'] ?? ($item['content'] ?? ''))
            ]
        ];
    })->toArray()
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
