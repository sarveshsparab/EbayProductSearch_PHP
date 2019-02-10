<?php
/**
 * Name: Sarvesh Parab
 * Date: 2/7/2019
 * Time: 10:27 PM
 */
?>

<?php

// PHP to fetch PSForm data
if($_SERVER["REQUEST_METHOD"] == "POST"){

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

    $ebayFindingAPICallResponse = file_get_contents($ebayFindingAPICallURL);
    exit($ebayFindingAPICallResponse);
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
                border: 2.5px solid #b4b4b4;
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
                display: block;
                margin-left: 75px;
                margin-right: 75px;
                margin-top: 25px;
            }
            .listings-container table{
                width: 100%;
                border-spacing: 0;
            }
            .listings-container table th{
                border-top: 1.5px solid #b4b4b4;
            }
            .listings-container table td *{
                max-height: 90px !important;
            }
            .listings-container table th:last-child{
                border-right: 1.5px solid #b4b4b4;
            }
            .listings-container table th, td{
                border-bottom: 1.5px solid #b4b4b4;
                border-left: 1.5px solid #b4b4b4;
                border-collapse: collapse;
            }
            .listings-container table tbody tr td:last-child{
                border-right: 1.5px solid #b4b4b4;
            }

            .details-container{
                background-color: darkgreen;
            }

            /* Misc */
            input:invalid {
                box-shadow: none;
            }
        </style>
    </head>

    <body>
        <!-- Product search form -->
        <div id="form-container" class="form-container">
            <form id="ps-form" class="ps-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

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
                    <button type="submit" id="ps-submit" name="ps-submit" disabled="disabled">Search</button>
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


    <!-- JS to fetch individual item details -->
    <script type="text/javascript">
        function fetchItemDetails(itemId) {
            alert(itemId);
        }
    </script>

    <!-- JS to submit the search form -->
    <script type="text/javascript">
        var psForm = document.getElementById("ps-form");
        psForm.addEventListener("submit", function(event) {
            event.preventDefault();

            if(validatePSForm()) {

                hideSecondaryDivs();

                var url = psForm.action;
                var params = "";
                var data = new FormData(psForm);
                for (const entry of data) {
                    params += entry[0] + "=" + encodeURIComponent(entry[1]) + "&";
                }
                params = params.slice(0, -1);
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", url, false);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(params);
                try {
                    var ebayFindingsAPIResult = JSON.parse(xhttp.responseText);

                    console.log(ebayFindingsAPIResult);

                    if(!anyItemsRetrieved(ebayFindingsAPIResult)){
                        showErrorMessage("No Records has been found");
                    } else {
                        var listingsTableHTML = buildListingsTable(ebayFindingsAPIResult);
                        document.getElementById('listings-container').innerHTML = listingsTableHTML;
                        document.getElementById('listings-container').style.display = "block";
                    }
                }catch(e){
                    showErrorMessage("Malformed JSON returned from ebayFindingsApi");
                    console.log("ERROR");
                    console.log(ebayFindingsAPIResult);
                }
            }
        }, false);
    </script>

    <!-- JS to check if the ebay finding API returned any valid result or not -->
    <script type="text/javascript">
        function anyItemsRetrieved(jsonObj) {
            var retrievedValidItems = true;
            if(jsonObj == null || jsonObj.length == 0)
                retrievedValidItems = false;
            else if (jsonObj.findItemsAdvancedResponse == null || jsonObj.findItemsAdvancedResponse.length == 0)
                retrievedValidItems = false;
            else if (jsonObj.findItemsAdvancedResponse[0].searchResult == null ||
                jsonObj.findItemsAdvancedResponse[0].searchResult.length == 0)
                retrievedValidItems = false;
            else if (jsonObj.findItemsAdvancedResponse[0].searchResult[0].item == null ||
                jsonObj.findItemsAdvancedResponse[0].searchResult[0].item.length == 0)
                retrievedValidItems = false;
            return retrievedValidItems;
        }
    </script>

    <!-- JS to build the search results listings -->
    <script type="text/javascript">
        function buildListingsTable(jsonObj) {
            let colHeaders = ["Index", "Photo", "Name", "Price", "Condition", "Shipping Option"];

            let tableElem = document.createElement('table');
            tableElem.setAttribute("cellspacing","0");

            let tHeadElem = tableElem.createTHead();
            let tHeadRow = tHeadElem.insertRow(0);

            for(let h=0; h < colHeaders.length; h++){
                let tHeadCell = document.createElement('th');
                tHeadCell.innerHTML = "<b>"+colHeaders[h]+"</b>";
                tHeadCell.setAttribute("style", "text-align:center;");
                tHeadRow.appendChild(tHeadCell);
            }

            let dataRows = jsonObj.findItemsAdvancedResponse[0].searchResult[0].item;
            let tBodyElem = tableElem.createTBody();

            for(let r=0; r < dataRows.length; r++){
                let tBodyRow = tBodyElem.insertRow(r);
                let cellCount = 0;
                let tBodyCell;

                // Index Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                tBodyCell.innerHTML = r + 1;

                // Photo Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                buildImageCell(tBodyCell, dataRows[r]);
                tBodyCell.setAttribute("style", "text-align: center;");

                // Name Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                buildNameCell(tBodyCell, dataRows[r]);

                // Price Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                tBodyCell.innerHTML = buildCurrencyString(dataRows[r]);

                // Condition Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                tBodyCell.innerHTML = buildConditionString(dataRows[r]);

                // Shipping Option Cell
                tBodyCell = tBodyRow.insertCell(cellCount++);
                tBodyCell.innerHTML = buildShippingString(dataRows[r]);
            }

            return tableElem.outerHTML;
        }
    </script>

    <!-- JS helper functions for Listings Table Generation -->
    <script type="text/javascript">
        function buildImageCell(cell, jsonObj) {
            if(jsonObj.galleryURL !=null && jsonObj.galleryURL != "" && jsonObj.galleryURL.length != 0){
                let imageElem = document.createElement('img');
                imageElem.setAttribute("src", jsonObj.galleryURL[0]);
                cell.appendChild(imageElem);
            } else {
                cell.innerHTML = "";
            }
        }
        function buildNameCell(cell, jsonObj) {
            let spanElem = document.createElement('span');
            let titleElem = document.createTextNode(jsonObj["title"]);
            spanElem.setAttribute("onclick", "fetchItemDetails("+jsonObj.itemId[0]+")");
            spanElem.setAttribute("style", "cursor: pointer");
            spanElem.appendChild(titleElem);
            cell.appendChild(spanElem);
        }
        function buildCurrencyString(jsonObj) {
            let currStr = '';
            if (jsonObj.sellingStatus == null || jsonObj.sellingStatus.length == 0) {
                currStr = 'N/A';
            } else if (jsonObj.sellingStatus[0].currentPrice == null ||
                jsonObj.sellingStatus[0].currentPrice.length == 0) {
                currStr = 'N/A';
            } else {
                // if(jsonObj.sellingStatus[0].currentPrice[0].@currencyId == "USD") {
                //     currStr = '$';
                // } else {
                //     currStr = '';
                // }
                currStr = '$';
                currStr += jsonObj.sellingStatus[0].currentPrice[0].__value__;
            }
            return currStr;
        }
        function buildConditionString(jsonObj) {
            let condStr = '';
            if (jsonObj.condition == null || jsonObj.condition.length == 0) {
                condStr = 'N/A';
            } else if (jsonObj.condition[0].conditionDisplayName == null ||
                jsonObj.condition[0].conditionDisplayName.length == 0) {
                condStr = 'N/A';
            } else {
                condStr = jsonObj.condition[0].conditionDisplayName[0];
            }
            return condStr;
        }
        function buildShippingString(jsonObj) {
            let shipStr = '';
            if(jsonObj.shippingInfo == null || jsonObj.shippingInfo.length == 0) {
                shipStr = 'N/A';
            } else if(jsonObj.shippingInfo[0].shippingServiceCost == null ||
                jsonObj.shippingInfo[0].shippingServiceCost.length == 0) {
                shipStr = 'N/A';
            } else {
                if(jsonObj.shippingInfo[0].shippingServiceCost[0].__value__ > 0) {
                    shipStr = '$';
                    shipStr += jsonObj.shippingInfo[0].shippingServiceCost[0].__value__;
                }else{
                    shipStr = 'Free Shipping';
                }
            }
            return shipStr;
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
            hideSecondaryDivs();

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

    <!-- JS to hide/close the secomdary divs -->
    <script type="text/javascript">
        function hideSecondaryDivs() {
            document.getElementById('error-notify').style.display = "none";
            document.getElementById('listings-container').style.display = "none";
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
