<?php
/**
 * Name: Sarvesh Parab
 * Date: 2/7/2019
 * Time: 10:27 PM
 */
?>

<?php
// PHP to fetch PSForm data
if(isset($_POST['ps-submit'])){

    $keyword = '';
    $category = -1;
    $condition_new = false;
    $condition_used = false;
    $condition_unspecified = false;
    $shipping_local = false;
    $shipping_free = false;
    $miles = 10;
    $zipCode_entered = '';
    $zipCode = '';

    if (isset($_POST['ps-keyword']) && !empty($_POST['ps-keyword'])) {
        $keyword = $_POST['ps-keyword'];
    }

    if (isset($_POST['ps-category']) && !empty($_POST['ps-category'])) {
        $category = $_POST['ps-category'];
    }

    if (isset($_POST['ps-condition-new']) && !empty($_POST['ps-condition-new'])) {
        $condition_new = true;
    }
    if (isset($_POST['ps-condition-used']) && !empty($_POST['ps-condition-used'])) {
        $condition_used = true;
    }
    if (isset($_POST['ps-condition-unspecified']) && !empty($_POST['ps-condition-unspecified'])) {
        $condition_unspecified = true;
    }

    if (isset($_POST['ps-shipping-local']) && !empty($_POST['ps-shipping-local'])) {
        $shipping_local = true;
    }
    if (isset($_POST['ps-shipping-free']) && !empty($_POST['ps-shipping-free'])) {
        $shipping_free = true;
    }

    if (isset($_POST['ps-miles']) && !empty($_POST['ps-miles'])) {
        $miles = $_POST['ps-miles'];
    }

    if (isset($_POST['ps-zip-code']) && !empty($_POST['ps-zip-code'])) {
        $zipCode_entered = $_POST['ps-zip-code'];
        $zipCode = $zipCode_entered;
    } else {
        $zipCode = $_POST['ps-here-zipcode'];
    }

    $ebayFindingAPICallURL = '';
    $ebayFindingAPICallURL .= 'http://svcs.ebay.com/services/search/FindingService/v1?';
    $ebayFindingAPICallURL .= 'OPERATION-NAME=findItemsAdvanced';
    $ebayFindingAPICallURL .='&SERVICE-VERSION=1.0.0';
    $ebayFindingAPICallURL .='&SECURITY-APPNAME='.'SarveshP-sarveshp-PRD-4a6d4ee64-9b547e7c';
    $ebayFindingAPICallURL .='&RESPONSE-DATA-FORMAT=JSON';
    $ebayFindingAPICallURL .='&REST-PAYLOAD';
    $ebayFindingAPICallURL .='&paginationInput.entriesPerPage=20';
    $ebayFindingAPICallURL .='&keywords='.$keyword;
    if($category != -1) {
        $ebayFindingAPICallURL .= '&categoryId=' . $category;
    }
    if($shipping_free) {
        $ebayFindingAPICallURL .= '&itemFilter.name=FreeShippingOnly';
        $ebayFindingAPICallURL .= '&itemFilter.value=true';
    }
    if($shipping_local) {
        $ebayFindingAPICallURL .= '&itemFilter.name=LocalPickupOnly';
        $ebayFindingAPICallURL .= '&itemFilter.value=true';
    }
    if($condition_new || $condition_used || $condition_unspecified) {
        $ebayFindingAPICallURL .= '&itemFilter.name=Condition';
        if($condition_new) {
            $ebayFindingAPICallURL .= '&itemFilter.value=New';
        }
        if($condition_used) {
            $ebayFindingAPICallURL .= '&itemFilter.value=Used';
        }
        if($condition_unspecified) {
            $ebayFindingAPICallURL .= '&itemFilter.value=Unspecified';
        }
    }
    $ebayFindingAPICallURL .='&buyerPostalCode='.$zipCode;
    $ebayFindingAPICallURL .='&MaxDistance='.$miles;

    //echo $ebayFindingAPICallURL;

    $ebayFindingAPICallResponse = file_get_contents($ebayFindingAPICallURL);
    //$ebayFindingAPICallResponse = json_decode($ebayFindingAPICallResponse);

//    $ebayFindingAPICallResponse = "adsdaf";
    //echo $ebayFindingAPICallResponse;

    //$x = '{"findItemsAdvancedResponse":[{"ack":["Success"],"version":["1.13.0"],"timestamp":["2019-02-09T09:48:05.626Z"],"searchResult":[{"@count":"20","item":[{"itemId":["192778570741"],"title":["USC Southern Cal Trojans Embroidered Iron On Patch Old Stock 3\u201d X 3\u201d"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["64484"],"categoryName":["Patches"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/m1tDqBNJ0Kv2y26ElaFgIRA\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/USC-Southern-Cal-Trojans-Embroidered-Iron-Patch-Old-Stock-3-X-3-\/192778570741"],"autoPay":["true"],"postalCode":["10307"],"location":["Staten Island,NY,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"0.0"}],"shippingType":["Free"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["2"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"6.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"6.99"}],"sellingState":["Active"],"timeLeft":["P22DT14H12M10S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-01-03T00:00:15.000Z"],"endTime":["2019-03-04T00:00:15.000Z"],"listingType":["StoreInventory"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"2440.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["123529720393"],"title":["USC TROJANS NCAA COLLEGE 2\" INTERLOCKED LETTERS LOGO TEAM PATCH VERSION 2"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["24541"],"categoryName":["College-NCAA"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/mLVEnpsaZBzw7DrGr6o1dpg\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/USC-TROJANS-NCAA-COLLEGE-2-INTERLOCKED-LETTERS-LOGO-TEAM-PATCH-VERSION-2-\/123529720393"],"paymentMethod":["PayPal","VisaMC","Discover"],"autoPay":["false"],"postalCode":["12211"],"location":["Albany,NY,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"0.0"}],"shippingType":["Free"],"shipToLocations":["Worldwide"],"expeditedShipping":["true"],"oneDayShippingAvailable":["false"],"handlingTime":["1"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"4.95"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"4.95"}],"sellingState":["Active"],"timeLeft":["P25DT6H32M52S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2018-12-06T16:20:57.000Z"],"endTime":["2019-03-06T16:20:57.000Z"],"listingType":["StoreInventory"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"2460.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["254112566281"],"title":["USC TROJANS Carl Banks Hooded Heavy Zipper Jacket Sweatshirt Size XL College "],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["24541"],"categoryName":["College-NCAA"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/mw5vp2wbYBoAbIKQGXtyNLw\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/USC-TROJANS-Carl-Banks-Hooded-Heavy-Zipper-Jacket-Sweatshirt-Size-XL-College-\/254112566281"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90638"],"location":["La Mirada,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"7.71"}],"shippingType":["Calculated"],"shipToLocations":["Worldwide"],"expeditedShipping":["true"],"oneDayShippingAvailable":["false"],"handlingTime":["1"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"24.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"24.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P4DT17H53M9S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-07T03:41:14.000Z"],"endTime":["2019-02-14T03:41:14.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"20.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["113626510379"],"title":["USC Trojans Game Used Football Nike "],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50118"],"categoryName":["College-NCAA"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mLOncerL9MKfz2huxNSNjTg\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/USC-Trojans-Game-Used-Football-Nike-\/113626510379"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90241"],"location":["Downey,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"15.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["2"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"199.0"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"199.0"}],"sellingState":["Active"],"timeLeft":["P29DT18H20M51S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-09T04:08:56.000Z"],"endTime":["2019-03-11T04:08:56.000Z"],"listingType":["FixedPrice"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202404945706"],"title":["USC Southern Cal Trojans Embroidered Iron On Patch Old Stock) 2.5\u201d X 2.5\u201d"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["64484"],"categoryName":["Patches"]}],"galleryURL":["http:\/\/thumbs3.ebaystatic.com\/m\/mnH0Ja0g-DipJym-75-6Nng\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/USC-Southern-Cal-Trojans-Embroidered-Iron-Patch-Old-Stock-2-5-X-2-5-\/202404945706"],"autoPay":["true"],"postalCode":["10307"],"location":["Staten Island,NY,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"0.0"}],"shippingType":["Free"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["2"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"5.79"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"5.79"}],"sellingState":["Active"],"timeLeft":["P3DT4H15M23S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2018-08-16T14:03:28.000Z"],"endTime":["2019-02-12T14:03:28.000Z"],"listingType":["StoreInventory"],"gift":["false"],"watchCount":["4"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"2440.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["352588860651"],"title":["Authentic Game Worn 2013\/2014 USC Trojans Basketball Shorts 48 NIKE RARE"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50118"],"categoryName":["College-NCAA"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mEiKdZXZY8Iu7V7n_nuTYZg\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/Authentic-Game-Worn-2013-2014-USC-Trojans-Basketball-Shorts-48-NIKE-RARE-\/352588860651"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["92506"],"location":["Riverside,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"8.0"}],"shippingType":["Calculated"],"shipToLocations":["Worldwide"],"expeditedShipping":["true"],"oneDayShippingAvailable":["false"],"handlingTime":["2"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"149.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"149.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P5DT14H42M51S"]}],"listingInfo":[{"bestOfferEnabled":["true"],"buyItNowAvailable":["false"],"startTime":["2019-02-08T00:30:56.000Z"],"endTime":["2019-02-15T00:30:56.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["3"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"55.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["233114995388"],"title":["Marcus Allen USC Trojans McFarlane Action Figure College Series 4 Football new"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["24541"],"categoryName":["College-NCAA"]}],"galleryURL":["http:\/\/thumbs1.ebaystatic.com\/m\/mJAgVxtgb5fP8x2UgnpozZw\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/Marcus-Allen-USC-Trojans-McFarlane-Action-Figure-College-Series-4-Football-new-\/233114995388"],"paymentMethod":["PayPal"],"autoPay":["true"],"postalCode":["60097"],"location":["Wonder Lake,IL,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"0.0"}],"shippingType":["Free"],"shipToLocations":["Worldwide"],"expeditedShipping":["true"],"oneDayShippingAvailable":["false"],"handlingTime":["1"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"17.95"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"17.95"}],"sellingState":["Active"],"timeLeft":["P20DT3H51M27S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-01-30T13:39:32.000Z"],"endTime":["2019-03-01T13:39:32.000Z"],"listingType":["StoreInventory"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"1715.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585791815"],"title":["2003 USC Trojans vs Hawaii Wariors football program + flip card, National Champs"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/my3PNBYYIjuuFF8cxE1qcWw\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2003-USC-Trojans-vs-Hawaii-Wariors-football-program-flip-card-National-Champs-\/202585791815"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H50M32S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:38:37.000Z"],"endTime":["2019-02-10T02:38:37.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202589174564"],"title":["1998 USC Trojans at Florida State Seminoles college football program"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["64492"],"categoryName":["College - NCAA"]}],"galleryURL":["http:\/\/thumbs1.ebaystatic.com\/m\/mV55uZgShgNlxh-9SDzfhzQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/1998-USC-Trojans-Florida-State-Seminoles-college-football-program-\/202589174564"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"bidCount":["1"],"sellingState":["Active"],"timeLeft":["P3DT11H9M47S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-05T20:57:52.000Z"],"endTime":["2019-02-12T20:57:52.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585772607"],"title":["2002 USC Trojans vs Cal Bears football press ribbon"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mZl74bj7jYX7TXTZxSg2FTw\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2002-USC-Trojans-vs-Cal-Bears-football-press-ribbon-\/202585772607"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"2.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT15H59M55S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T01:48:00.000Z"],"endTime":["2019-02-10T01:48:00.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585776302"],"title":["1998 USC Trojans vs Washington Huskies football program-homecoming"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs3.ebaystatic.com\/m\/mWrAg0i7Nk9wzo3Ei4r4fMA\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/1998-USC-Trojans-vs-Washington-Huskies-football-program-homecoming-\/202585776302"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"0.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H13M2S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:01:07.000Z"],"endTime":["2019-02-10T02:01:07.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["254098761167"],"title":["Pete Beathard USC Trojans College Football Golden Age Card"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["215"],"categoryName":["Football Cards"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mEHU6U0Ku9ojYsZtqdoSorQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/Pete-Beathard-USC-Trojans-College-Football-Golden-Age-Card-\/254098761167"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["75701"],"location":["Tyler,TX,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"2.95"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["2"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"6.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"6.99"}],"sellingState":["Active"],"timeLeft":["P17DT18H14M28S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-01-28T04:02:33.000Z"],"endTime":["2019-02-27T04:02:33.000Z"],"listingType":["StoreInventory"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["true"],"distance":[{"@unit":"mi","__value__":"1335.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585794991"],"title":["2005 USC Trojans vs UCLA football program, National Champs, Reggie Bush cover"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mhfF9fkk7WPZgqqC-VtPPeQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2005-USC-Trojans-vs-UCLA-football-program-National-Champs-Reggie-Bush-cover-\/202585794991"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"4.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"4.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H59M7S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:47:12.000Z"],"endTime":["2019-02-10T02:47:12.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202589195777"],"title":["2004 USC Trojans at UCLA Bruins college football program"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["64492"],"categoryName":["College - NCAA"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/miV_6Uzekxw81VHhLrtralQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2004-USC-Trojans-UCLA-Bruins-college-football-program-\/202589195777"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"bidCount":["1"],"sellingState":["Active"],"timeLeft":["P3DT11H44M4S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-05T21:32:09.000Z"],"endTime":["2019-02-12T21:32:09.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585793342"],"title":["2003 USC Trojans vs Washington State football program, National Champs"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs3.ebaystatic.com\/m\/mKKSKiDvgbcTh4TFE0Ohj1A\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2003-USC-Trojans-vs-Washington-State-football-program-National-Champs-\/202585793342"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H54M15S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:42:20.000Z"],"endTime":["2019-02-10T02:42:20.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585792598"],"title":["2003 USC Trojans vs Stanford football program + flip card, National Champs"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs3.ebaystatic.com\/m\/mELxBcpNzll0P5x-ky4BWyg\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2003-USC-Trojans-vs-Stanford-football-program-flip-card-National-Champs-\/202585792598"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H52M24S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:40:29.000Z"],"endTime":["2019-02-10T02:40:29.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585777167"],"title":["1999 USC Trojans vs UCLA Bruins football program and flip card"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs4.ebaystatic.com\/m\/mpVf5ShJqyE6aWsOk7Qcn9Q\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/1999-USC-Trojans-vs-UCLA-Bruins-football-program-and-flip-card-\/202585777167"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"2.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"2.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H15M15S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:03:20.000Z"],"endTime":["2019-02-10T02:03:20.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["2"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["264184401197"],"title":["2018-19  USC Trojans Men\'s Basketball Media Guide"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["73429"],"categoryName":["Media Guides"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/mKpmqCl9vgtKy7sJTWNXhzQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2018-19-USC-Trojans-Mens-Basketball-Media-Guide-\/264184401197"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["91754"],"location":["Monterey Park,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"3.17"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["3"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"9.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"9.99"}],"sellingState":["Active"],"timeLeft":["P27DT21H19M34S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-07T07:07:39.000Z"],"endTime":["2019-03-09T07:07:39.000Z"],"listingType":["FixedPrice"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585794121"],"title":["2004 USC Trojans vs Colorado State Rams football program, National Champs"],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs2.ebaystatic.com\/m\/mopzBRdCGDZICAwOGdORvTw\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2004-USC-Trojans-vs-Colorado-State-Rams-football-program-National-Champs-\/202585794121"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"1.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H56M27S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:44:32.000Z"],"endTime":["2019-02-10T02:44:32.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]},{"itemId":["202585788248"],"title":["2001 USC Trojans vs San Jose State football program-Pete Carroll first game SC "],"globalId":["EBAY-US"],"primaryCategory":[{"categoryId":["50132"],"categoryName":["Ticket Stubs"]}],"galleryURL":["http:\/\/thumbs1.ebaystatic.com\/m\/mZ6fPfmvXESIFxqTo3b9aYQ\/140.jpg"],"viewItemURL":["http:\/\/www.ebay.com\/itm\/2001-USC-Trojans-vs-San-Jose-State-football-program-Pete-Carroll-first-game-SC-\/202585788248"],"paymentMethod":["PayPal"],"autoPay":["false"],"postalCode":["90291"],"location":["Venice,CA,USA"],"country":["US"],"shippingInfo":[{"shippingServiceCost":[{"@currencyId":"USD","__value__":"5.0"}],"shippingType":["Flat"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"],"handlingTime":["0"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"4.99"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"4.99"}],"bidCount":["0"],"sellingState":["Active"],"timeLeft":["P0DT16H42M59S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2019-02-03T02:31:04.000Z"],"endTime":["2019-02-10T02:31:04.000Z"],"listingType":["Auction"],"gift":["false"],"watchCount":["1"]}],"returnsAccepted":["false"],"distance":[{"@unit":"mi","__value__":"10.0"}],"isMultiVariationListing":["false"],"topRatedListing":["false"]}]}],"paginationOutput":[{"pageNumber":["1"],"entriesPerPage":["20"],"totalPages":["1210"],"totalEntries":["24200"]}],"itemSearchURL":["http:\/\/www.ebay.com\/sch\/i.html?LH_ItemCondition=0&_nkw=usc&_ddo=1&_ipg=20&_pgn=1&_pos=90007&_stpos=90007"]}]}';

    $ebayFindingAPICallResponse = "{'fruit': 'Apple','size': 'Large','color': 'Red'}";
    $retVal = '<input type="text" id="retval" name="retval" hidden="hidden" value="'.$ebayFindingAPICallResponse.'" >';
    $retVal .= "<script>generateListings();</script>";
    echo $retVal;
}

?>

<html>
    <head>
        <title>Product Search</title>
        <style>

            /* PS Form CSS */
            .form-container{
                background-color: #f6f6f6;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 40px;
                border: 2px solid #b4b4b4;
                height: 285px;
                width: 600px;
            }
            .ps-form{

            }
            .ps-form header, footer{
                text-align: center;
            }
            .ps-form header{
                font-style: italic;
                font-size: 30px;
                margin-bottom: 7px;
            }
            .ps-form fieldset{
                border: none;
                border-top: 1px solid rgba(25, 25, 25, 0.6);
                margin-left: 10px;
                margin-right: 10px;
                padding-top: 10px;
            }
            .ps-form fieldset label{
                display: block;
                margin-bottom: 10px;
            }
            .ps-form fieldset label span{
                font-weight: bold;
            }
            .ps-form fieldset select{
                width: 225px;
            }
            .ps-form fieldset input[type="checkbox"]{
                margin-left: 25px;
            }
            .ps-form footer{
                margin-top: 10px;
            }

            /* Disabled states formatting */
            input:disabled {
                background: #efefef;
                color: #a0a0a0;
            }
            input:disabled::placeholder {
                color: #a0a0a0;
            }
            input:disabled+label {
                color: #8c8c8c;
            }

            /* Error notification div CSS */
            .error-notify-div{
                display: none;
                margin-left: auto;
                margin-right: auto;
                margin-top: 30px;
                width: 750px;
                height: 20px;
                text-align: center;
                font-size: 16px;
                border: 1px solid #b4b4b4;
                background-color: #dddddd;
            }

            /* Search results listing div CSS */
            .listings-container{
                background-color: yellow;
                display: block;
                margin-left: 50px;
                margin-right: 50px;
                margin-top: 25px;
                height: 300px;
            }

            .details-container{
                background-color: darkgreen;
            }
        </style>
    </head>

    <body>
        <!-- Product search form -->
        <div id="form-container" class="form-container">
            <form id="ps-form" class="ps-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  onsubmit="return validatePSForm()">

                <header>Product Search</header>

                <fieldset>
                    <label><span>Keyword</span>
                        <input type="text" id="ps-keyword" name="ps-keyword" required autocomplete="off"
                               value="<?php echo isset($_POST['ps-keyword']) ? $_POST['ps-keyword'] : '' ?>" >
                    </label>

                    <label><span>Category</span>
                        <select id="ps-category" name="ps-category">
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==-1){ ?>selected<?php }?>
                                    value="-1">All Categories</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==0){ ?>selected<?php }?>
                                    value="0" disabled="disabled">--------------------------------</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==550){ ?>selected<?php }?>
                                    value="550">Art</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==2984){ ?>selected<?php }?>
                                    value="2984">Baby</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==267){ ?>selected<?php }?>
                                    value="267">Books</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==11450){ ?>selected<?php }?>
                                    value="11450">Clothing, Shoes & Accessories</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==58058){ ?>selected<?php }?>
                                    value="58058">Computers/Tablets & Networking</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==26395){ ?>selected<?php }?>
                                    value="26395">Health & Beauty</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==11233){ ?>selected<?php }?>
                                    value="11233">Music</option>
                            <option <?php if(isset($_POST['ps-category']) && !empty($_POST['ps-category'])
                                    && $_POST['ps-category']==1249){ ?>selected<?php }?>
                                    value="1249">Video Games & Consoles</option>
                        </select>
                    </label>

                    <label for=""><span>Condition</span>
                        <input type="checkbox" id="ps-condition-new" name="ps-condition-new"
                            <?php echo (isset($_POST['ps-condition-new']))? "checked='checked'": "";?> >New
                        <input type="checkbox" id="ps-condition-used" name="ps-condition-used"
                            <?php echo (isset($_POST['ps-condition-used']))? "checked='checked'": "";?> >Used
                        <input type="checkbox" id="ps-condition-unspecified" name="ps-condition-unspecified"
                            <?php echo (isset($_POST['ps-condition-unspecified']))? "checked='checked'": "";?> >Unspecified
                    </label>

                    <label for=""><span>Shipping Options</span>
                        <input type="checkbox" id="ps-shipping-local" name="ps-shipping-local"
                            <?php echo (isset($_POST['ps-shipping-local']))? "checked='checked'": "";?> >Local Pickup
                        <input type="checkbox" id="ps-shipping-free" name="ps-shipping-free"
                            <?php echo (isset($_POST['ps-shipping-free']))? "checked='checked'": "";?> >Free Shipping
                    </label>

                    <label style="display: inline" for="">
                        <input type="checkbox" style="margin-left: unset" id="ps-enable-nearby" name="ps-enable-nearby"
                               onchange="toggleNearByState()"
                            <?php echo (isset($_POST['ps-enable-nearby']))? "checked='checked'": "";?> >
                            <span>Enable Nearby Search</span>
                    </label>

                    <input type="text" style="width: 60px; margin-left: 30px;" id="ps-miles" name="ps-miles"
                        value="<?php echo isset($_POST['ps-miles']) ? $_POST['ps-miles'] : '10' ?>"
                        <?php if(!isset($_POST['ps-enable-nearby'])){ ?> disabled="disabled" <?php } ?>
                        autocomplete="off" >
                    <label for="ps-miles" style="display: inline"><span>miles from</span></label>

                    <input type="radio" id="ps-here-radio" name="ps-nearby-location" onchange="toggleNearByZipCode()"
                        value="0"
                        <?php if((isset($_POST['ps-nearby-location'])
                            && $_POST['ps-nearby-location']==0)
                            || !isset($_POST['ps-nearby-location'])){ ?> checked <?php } ?>
                        <?php if(!isset($_POST['ps-enable-nearby'])){ ?> disabled="disabled" <?php } ?> >
                    <label for="ps-here-radio" style="display: inline">Here</label>

                    <input type="text" id="ps-here-zipcode" name="ps-here-zipcode" hidden="hidden"><br>

                    <input type="radio" style="margin-left: 353px" id="ps-zip-radio" name="ps-nearby-location"
                        onchange="toggleNearByZipCode()" value="1"
                        <?php if(isset($_POST['ps-nearby-location'])
                            && $_POST['ps-nearby-location']==1){ ?> checked <?php } ?>
                        <?php if(!isset($_POST['ps-enable-nearby'])){ ?> disabled="disabled" <?php } ?> >

                    <input type="text" placeholder="zip code" style="margin-left: 5px; width: 100px;"
                        id="ps-zip-code" name="ps-zip-code" required autocomplete="off"
                        value="<?php echo isset($_POST['ps-zip-code']) ? $_POST['ps-zip-code'] : '' ?>"
                        <?php if(isset($_POST['ps-enable-nearby'])
                            && isset($_POST['ps-nearby-location'])
                            && $_POST['ps-nearby-location']==1){ } else { ?> disabled="disabled" <?php } ?> >
                </fieldset>

                <footer>
                    <input type="submit" value="Search" id="ps-submit" name="ps-submit" disabled="disabled">
                    <input type="button" value="Clear" onclick="clearPSForm()" id="ps-clear" name="ps-clear">
                </footer>
            </form>
        </div>

        <!-- Error notification div -->
        <div id="error-notify" class="error-notify-div">

        </div>

        <!-- Search results listing div -->
        <div id="listings-container"  class="listings-container">

        </div>

        <div id="details-container"  class="details-container">
            <div id="details-table-container">

            </div>
            <div id="details-seller-message-container">

            </div>
            <div id="details-similar-items-container">

            </div>
        </div>

    <!-- JS to populate the search results listings -->
    <script type="text/javascript">
        function generateListings() {
            alert("hi");
        }
    </script>


    <!--  JS Script for search form validation and enable nearby search feature  -->
    <script type="text/javascript">
        function toggleNearByState() {
            let isNearByChecked = document.getElementById('ps-enable-nearby').checked;
            document.getElementById('ps-miles').disabled = !isNearByChecked;
            document.getElementById('ps-here-radio').disabled = !isNearByChecked;
            document.getElementById('ps-zip-radio').disabled = !isNearByChecked;
            document.getElementById('ps-zip-code').disabled = document.getElementById('ps-zip-radio').checked;
            if(document.getElementById('ps-zip-radio').checked){
                document.getElementById('ps-zip-code').disabled = false;
            }else{
                document.getElementById('ps-zip-code').disabled = true;
            }
        }
    </script>

    <!-- JS to toggle the zip code text box -->
    <script type="text/javascript">
        function toggleNearByZipCode() {
            if(document.getElementById('ps-zip-radio').checked){
                document.getElementById('ps-zip-code').disabled = false;
            }else{
                document.getElementById('ps-zip-code').disabled = true;
            }
        }
    </script>

    <!--  JS to reset the form data when clear pressed -->
    <script type="text/javascript">
        function clearPSForm() {
            document.getElementById('ps-keyword').value = '';
            document.getElementById('ps-category').value = -1;
            document.getElementById('ps-condition-new').checked = false;
            document.getElementById('ps-condition-used').checked = false;
            document.getElementById('ps-condition-unspecified').checked = false;
            document.getElementById('ps-shipping-free').checked = false;
            document.getElementById('ps-shipping-local').checked = false;
            document.getElementById('error-notify').style.display = "none";
            document.getElementById('listings-container').style.display = "none";

            let isNearByChecked = document.getElementById('ps-enable-nearby').checked;
            if (isNearByChecked) {
                document.getElementById('ps-enable-nearby').checked = false;
                document.getElementById('ps-miles').disabled = true;
                document.getElementById('ps-miles').value = '10';
                document.getElementById('ps-here-radio').disabled = true;
                document.getElementById('ps-here-radio').checked = true;
                document.getElementById('ps-zip-radio').disabled = true;
                document.getElementById('ps-zip-radio').checked = false;
                document.getElementById('ps-zip-code').disabled = true;
                document.getElementById('ps-zip-code').value = '';
            }
        }
    </script>

    <!-- JS to validate PS Form on submit click -->
    <script type="text/javascript">
        function validatePSForm() {
            let formState = true;

            // Validations for nearby search
            if(document.getElementById('ps-enable-nearby').checked){

                // Validations for zip code
                if(document.getElementById('ps-zip-radio').checked){
                    let zipCodeEntered = document.getElementById('ps-zip-code').value;
                    if(!isZipCodeValid(zipCodeEntered)){
                        showErrorMessage("Zipcode is invalid");
                        formState = false;
                    }
                }

                // Validations for miles radius
                if(document.getElementById('ps-miles').value == "" ||
                    document.getElementById('ps-miles').value.length == 0 ){
                    showErrorMessage("Miles cannot be empty");
                    formState = false;
                }
                if(document.getElementById('ps-miles').value < 0){
                    showErrorMessage("Miles cannot be negative");
                    formState = false;
                }
                if(! /^\d+$/.test(document.getElementById('ps-miles').value)){
                    showErrorMessage("Miles have to be numeric");
                    formState = false;
                }
            }

            return formState;
        }
    </script>

    <!-- JS to show the error messages on screen -->
    <script type="text/javascript">
        function showErrorMessage(msg) {
            var errorDiv = document.getElementById('error-notify');
            errorDiv.innerText = msg;
            errorDiv.style.display = "block";
        }
    </script>

    <!-- JS to validate zip code -->
    <script type="text/javascript">
        function isZipCodeValid(zcVal) {
            return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zcVal)
        }
    </script>

    <!-- JS to fetch JSON from an API URL -->
    <script type="text/javascript">
        function fetchJSONFromURL(apiURL) {
            var jsonStr = ""

            var xmlHTTPRequest = new XMLHttpRequest();
            xmlHTTPRequest.onreadystatechange = function () {
                if (xmlHTTPRequest.readyState == XMLHttpRequest.DONE ) {
                    if(xmlHTTPRequest.status==200) {
                        jsonStr = xmlHTTPRequest.responseText;
                    } else if (xmlHTTPRequest.status==404) {
                        jsonStr = "error-404-[FileNotFound] - " + apiURL;
                    } else {
                        jsonStr = "error-000-[Empty Response]";
                    }
                } else {
                    jsonStr = "error-000-[Empty Response]";
                }
            }

            xmlHTTPRequest.open("GET", apiURL, false);
            xmlHTTPRequest.send();

            return jsonStr;
        }
    </script>

    <!-- JS to fetch current location IP on page load -->
    <script type="text/javascript">
        window.onload = function (e) {
            let ipAPIURL = "http://ip-api.com/json";
            let ipAPIJSON = fetchJSONFromURL(ipAPIURL);
            if(ipAPIJSON.startsWith("error")){
                showErrorMessage(ipAPIJSON);
            }else{
                try{
                    var ipAPIJSONObj = JSON.parse(ipAPIJSON);
                }
                catch(e){
                    showErrorMessage("Malformed JSON encountered at URL [ "+ipAPIURL+" ]");
                }
                document.getElementById('ps-here-zipcode').value = ipAPIJSONObj["zip"];
                document.getElementById('ps-submit').disabled = false;
            }
        }
    </script>
    </body>
</html>
