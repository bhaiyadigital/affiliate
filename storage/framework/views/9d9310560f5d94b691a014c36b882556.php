<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
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
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<title><?php echo e($finalTitle); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="<?php echo e($finalTitle); ?>">
<meta name="description" content="<?php echo e($description); ?>">
<?php if($keywords): ?>
    <meta name="keywords" content="<?php echo e($keywords); ?>">
<?php endif; ?>
<meta name="author" content="<?php echo e($siteName); ?>">
<link rel="canonical" href="<?php echo e($canonical); ?>">


<meta property="og:type" content="<?php echo e($type == 'BlogPosting' ? 'article' : 'website'); ?>">
<meta property="og:title" content="<?php echo e($finalTitle); ?>">
<meta property="og:description" content="<?php echo e($description); ?>">
<meta property="og:url" content="<?php echo e($canonical); ?>">
<meta property="og:image" content="<?php echo e($image); ?>">
<meta property="og:site_name" content="<?php echo e($siteName); ?>">


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($finalTitle); ?>">
<meta name="twitter:description" content="<?php echo e($description); ?>">
<meta name="twitter:image" content="<?php echo e($image); ?>">


<script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>'=>'https://schema.org',
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
],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?>

</script>


<script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $siteName,
    'url' => url('/')
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

</script>


<script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>'=>'https://schema.org',
    '@type'=>'WebPage',
    'name'=>$title,
    'description'=>$description,
    'url'=>$canonical,
    'primaryImageOfPage'=>$image
],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?>

</script>


<?php if(count($breadcrumb)): ?>
    <script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>'=>'https://schema.org',
    '@type'=>'BreadcrumbList',
    'itemListElement'=>collect($breadcrumb)->values()->map(function($item,$index){

        return [
            '@type'=>'ListItem',
            'position'=>$index+1,
            'name'=>$item['name'],
            'item'=>$item['url']
        ];

    })->toArray()
],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT); ?>

</script>
<?php endif; ?>



<?php if($type == 'BlogPosting'): ?>
    <script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>'=>'https://schema.org',
    '@type'=>'BlogPosting',
    'headline' => $schema['headline'] ?? $finalTitle,
    'description' => $description,
    'image' => $image,
    'author' => ['@type' => 'Organization', 'name' => $siteName],
    'datePublished' => $schema['published'] ?? now()->toIso8601String(),

],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT); ?>

</script>
<?php endif; ?>



<?php if($type == 'FAQPage' && count($faq)): ?>
    <script type="application/ld+json">
<?php echo json_encode([
    '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
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
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

</script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\affiliate-project\resources\views/components/meta-info/meta.blade.php ENDPATH**/ ?>