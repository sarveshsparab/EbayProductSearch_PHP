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
    if (isset($_POST['ps-zip-code']) && !empty($_POST['ps-zip-code'])) {
        $zipcode = $_POST['ps-zip-code'];
    }
}

?>

<html>
    <head>
        <title>Product Search</title>
        <style>
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

            .listings-container{
                background-color: yellow;
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
                        <input type="text" id="ps-keyword" name="ps-keyword" required>
                    </label>
                    <label><span>Category</span>
                        <select id="ps-category" name="ps-category">
                            <option selected value="-1">All Categories</option>
                            <option value="0" disabled="disabled">--------------------------------</option>
                            <option value="550">Art</option>
                            <option value="2984">Baby</option>
                            <option value="267">Books</option>
                            <option value="11450">Clothing, Shoes & Accessories</option>
                            <option value="58058">Computers/Tablets & Networking</option>
                            <option value="26395">Health & Beauty</option>
                            <option value="11233">Music</option>
                            <option value="1249">Video Games & Consoles</option>
                        </select>
                    </label>
                    <label><span>Condition</span>
                        <input type="checkbox" id="ps-condition-new" name="ps-condition-new">New
                        <input type="checkbox" id="ps-condition-used" name="ps-condition-used">Used
                        <input type="checkbox" id="ps-condition-unspecified" name="ps-condition-unspecified">Unspecified
                    </label>
                    <label><span>Shipping Options</span>
                        <input type="checkbox" id="ps-shipping-local" name="ps-shipping-local">Local Pickup
                        <input type="checkbox" id="ps-shipping-free" name="ps-shipping-free">Free Shipping
                    </label>
                    <label style="display: inline">
                        <input type="checkbox" style="margin-left: unset" id="ps-enable-nearby" name="ps-enable-nearby"
                               onchange="toggleNearByState()">
                            <span>Enable Nearby Search</span>
                    </label>
                    <input type="text" style="width: 60px; margin-left: 30px;" value="10" id="ps-miles" name="ps-miles"
                           disabled="disabled">
                        <label for="ps-miles" style="display: inline"><span>miles from</span></label>
                    <input type="radio" id="ps-here-radio" name="nearby-location" checked  disabled="disabled"
                           onchange="toggleNearByZipCode()">
                        <label for="ps-here-radio" style="display: inline">Here</label><br>
                    <input type="radio" style="margin-left: 353px" id="ps-zip-radio" name="nearby-location"
                           disabled="disabled" onchange="toggleNearByZipCode()">
                        <input type="text" placeholder="zip code" style="margin-left: 5px; width: 100px;"
                               id="ps-zip-code" name="ps-zip-code" disabled="disabled" required>
                </fieldset>
                <footer>
                    <input type="submit" value="Search" id="ps-submit" name="ps-submit">
                    <input type="reset" value="Clear" onclick="clearPSForm()" id="ps-clear" name="ps-clear">
                </footer>
            </form>
        </div>

        <div id="error-notify" class="error-notify-div">

        </div>

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
            document.getElementById('ps-keyword').innerText = '';
            document.getElementById('ps-category').value = -1;
            document.getElementById('ps-condition-new').checked = false;
            document.getElementById('ps-condition-used').checked = false;
            document.getElementById('ps-condition-unspecified').checked = false;
            document.getElementById('ps-shipping-free').checked = false;
            document.getElementById('ps-shipping-local').checked = false;

            let isNearByChecked = document.getElementById('ps-enable-nearby').checked;
            if (isNearByChecked) {
                document.getElementById('ps-enable-nearby').checked = false;
                document.getElementById('ps-miles').disabled = true;
                document.getElementById('ps-miles').innerText = '10';
                document.getElementById('ps-here-radio').disabled = true;
                document.getElementById('ps-here-radio').checked = true;
                document.getElementById('ps-zip-radio').disabled = true;
                document.getElementById('ps-zip-radio').checked = false;
                document.getElementById('ps-zip-code').disabled = true;
                document.getElementById('ps-zip-code').innerText = '';
            }
        }
    </script>

    <!-- JS to handle submit button click -->
    <script>
        function validatePSForm() {

        }
    </script>
    </body>
</html>
