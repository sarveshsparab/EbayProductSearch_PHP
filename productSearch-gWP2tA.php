<?php
/**
 * Name: Sarvesh Parab
 * Date: 2/7/2019
 * Time: 10:27 PM
 */
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
            .search-form{

            }
            .search-form header, footer{
                text-align: center;
            }
            .search-form header{
                font-style: italic;
                font-size: 30px;
                margin-bottom: 7px;
            }
            .search-form fieldset{
                border: none;
                border-top: 1px solid rgba(25, 25, 25, 0.6);
                margin-left: 10px;
                margin-right: 10px;
            }
            .search-form fieldset label{
                display: block;
                margin-top: 10px;
            }
            .search-form fieldset label span{
                font-weight: bold;
            }
            .search-form fieldset select{
                width: 225px;
            }
            .search-form fieldset input[type="checkbox"]{
                margin-left: 25px;
            }
            .search-form footer{
                margin-top: 10px;
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
        <div id="form-container" class="form-container">
            <form id="search-form" class="search-form">
                <header>Product Search</header>
                <fieldset>
                    <label><span>Keyword</span>
                        <input type="text" id="ps-keyword" required>
                    </label>
                    <label><span>Category</span>
                        <select id="ps-category">
                            <option selected>All Categories</option>
                        </select>
                    </label>
                    <label><span>Condition</span>
                        <input type="checkbox" id="ps-condition-new">New
                        <input type="checkbox" id="ps-condition-used">Used
                        <input type="checkbox" id="ps-condition-unspecified">Unspecified
                    </label>
                    <label><span>Shipping Options</span>
                        <input type="checkbox" id="ps-shipping-local">Local Pickup
                        <input type="checkbox" id="ps-shipping-free">Free Shipping
                    </label>
                    <label>
                        <input type="checkbox" style="margin-left: unset" id="ps-enable-nearby">
                            <span>Enable Nearby Search</span>
                        <input type="text" style="width: 60px; margin-left: 30px;" value="10" id="ps-miles">
                            <span>miles from</span>
                        <input type="radio" id="ps-here-radio" name="nearby-location" checked>
                            Here<br>
                        <input type="radio" style="margin-left: 353px" id="ps-zip-radio" name="nearby-location">
                            <input type="text" placeholder="zip code" style="margin-left: 5px; width: 100px;"
                                   id="ps-zip-code">
                    </label>
                </fieldset>
                <footer>
                    <input type="submit" value="Search">
                    <input type="reset" value="Clear">
                </footer>
            </form>
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

    </body>
</html>
