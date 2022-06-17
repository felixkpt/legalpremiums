<?php 

$name = \Site::name();
$legalName = $name.' Ltd';
$description = \Site::description();
$sameAs = [
    
    'https://www.facebook.com/LegalPremiumsLtd',
];
$logo = [ '@id' => url('#/schema/ImageObject/Logo/1')];
$email = 'support@legalpremiums.com';
$permalink = url('companies/'.$post->slug);


$context = ["@context" => "https://schema.org"];
$graph = ["@graph" => []];

// 1st Item in graph array
$PostalAddress = [
        "@type" => "PostalAddress",
        "@id" => url('').("/#schema/PostalAddress/DK"),
        "streetAddress" => "Texas 18, 5th floor",
        "addressLocality" => "Abernathy",
        "addressCountry" => "US",
        "postalCode" => "79311 Hale County"
];

// 2nd Item in graph array
$ImageObject = [
    "@type" => "ImageObject",
    "@id" => url('').("/#schema/ImageObject/Logo/1"),
    "url" => url("public/images/logo.png"),
    "contentUrl" => url("public/images/logo.png"),
    "width" => [ "@type" => "QuantitativeValue", "value" => 451, "unitCode" => "E37", "unitText" => "pixel" ],
    "height" => [ "@type" => "QuantitativeValue", "value" => 130, "unitCode" => "E37", "unitText" => "pixel" ],
    "caption" => $name." Logo",
    "name" =>  $name
];

// 3rd Item in graph array
$WebSite = [
    "@type" => "WebSite",
    "@id" => url('').("/#schema/WebSite/1"),
    "url" => url('/'),
    "name" => $name,
    "description" => $description,
    "publisher" => [ "@id" => url('').("/#schema/Organization/1") ],
    "copyrightHolder" => [ "@id" => url('').("/#schema/Organization/1") ],
    "potentialAction" => [[ "@type" => "SearchAction", "target" => [ "@type" => "EntryPoint", "urlTemplate" => url("search?query=[search_term_string]") ], "query-input" => "required name=search_term_string" ]],
    "inLanguage" => "en-US"
];

// 4rd Item in graph array 
$WebPage = [
    "@type" => "WebPage",
    "@id" => $permalink,
    "url" => $permalink,
    "name" => $post->company_name,
    "description" => Str::limit(strip_tags($post->content->content), 120),
    "isPartOf" => [ "@id" => url('').("/#schema/WebSite/1") ],
    "inLanguage" => "en-US",
    "about" => [ "@id" => url('').("/#schema/Organization/".$post->company_name) ],
    "mainEntity" => [ "@id" => url('').("/#schema/Organization/".$post->company_name) ],
    "primaryImageOfPage" => [ "@id" => $post->image ],
    "hasPart" => [ "@id" => url('').("/#schema/DataSet/".$post->company_name."/1") ]
];

// 5rd Item in graph array 
$BreadcrumbList = [
    
];

// 6rd Item in graph array 
$LocalBusiness = [
    "@type" => "LocalBusiness",
    "@id" => url('').("/#schema/Organization/".$post->company_name),
    "url" => $permalink,
    "sameAs" => $post->company_url,
    "name" => $post->company_name,
    "description" => Str::limit(strip_tags($post->content->content), 120),
    "email" => "partners@".$post->company_url,
    "telephone" => "866-262-4478",
    "address" => [ "@type" => "PostalAddress", "streetAddress" => "2625 Augustine Dr., Suite 601", "addressLocality" => "Santa Clara", "addressCountry" => "US", "postalCode" => "95054" ],
    "image" => [ "@id" => url('').("/#schema/ImageObject/".$post->company_name) ],
    "aggregateRating" => [ "@type" => "AggregateRating", "bestRating" => "5", "worstRating" => "1", "ratingValue" => $post->rating, "reviewCount" => $post->reviews ],
    "review" => [
        [ "@id" => url('').("/#schema/Review/".$post->company_name."/6206a6d54f921071539ada84") ],
        [ "@id" => url('').("/#schema/Review/".$post->company_name."/6206a6d54f921071539ada84") ]
    ]
];

// 7rd Item in graph array 
$Review = [];
foreach ($reviews as $review) {

    $item =
        [
            "@type" => "Review",
            "@id" => url('').("/#schema/Review/" . $post->company_name . "/39ad62a8406a6d54f9210715"),
            "itemReviewed" => ["@id" => url('').("/#schema/Organization/" . $post->company_name)],
            "author" => ["@type" => "Person", "name" => $review->author->name, "url" => url('profile/'.$review->author->slug)],
            "datePublished" => $review->date_created,
            "headline" => $review->title,
            "reviewBody" => Str::limit(strip_tags($review->content), 100),
            "reviewRating" => ["@type" => "Rating", "bestRating" => "5", "worstRating" => "1", "ratingValue" => $review->rating],
            "publisher" => ["@id" => url('').("/#schema/Organization/1")],
            "inLanguage" => "en"
        ];

        $Review[] = $item;
    
}

$graph["@graph"] = [$PostalAddress, $ImageObject, $WebSite, $WebPage, $BreadcrumbList, $LocalBusiness, $Review];

// $graph["@graph"] = [$PostalAddress, $ImageObject];

$jsonLd = json_encode(array_merge($context, $graph), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$echo = '<script type="application/ld+json" data-business-unit-json-ld="true">'.
$jsonLd
.'</script>';

echo $echo;
?>
