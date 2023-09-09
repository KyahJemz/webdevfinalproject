<?php 
    require_once './auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAINAN - The latgest undeground canteen collections</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/hunt.css">
</head>
<body>
    <?php require './header.php' ?> 
    <div class="content">
        <div class="category-list-container">
            <p class="category-title title">Categories</p>
            <div class="scroll-container">
                <div class="list-container">
                    <a class="category-button list-item selected">Food</a>
                    <a class="category-button list-item selected">Chicker</a>
                    <a class="category-button list-item selected">fish</a>
                </div>
            </div>
        </div>
        <div class="hunt-grid-container">
            <p class="hunt-title title">Hunt Items</p>
            <div class="scroll-container">
                <div class="grid-container">
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                    <div class="grid-item" data-itemid="${item.ItemId}" data-itemname="${item.ItemName}" data-itemcategory="${item.ItemCategory}" data-itemprice="${item.ItemPrice}" data-itemimage="${item.ItemImage}" data-itemstorename="${item.StoreName}" data-itemstoreimage="${item.StoreImage}">
                        <div class="StoreName">${item.StoreName}</div>
                        <div class="ItemImage"><img src="../images/uploads/items/${item.ItemImage}" alt=""></div>
                        <div class="ItemName">${item.ItemName}</div>
                        <div class="ItemCategory">${item.ItemCategory}</div>
                        <div class="ItemPrice">${helper.formatPrice(item.ItemPrice)}</div>
                        <div class="Button"><button>Add to cart</button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-list-container">
            <p class="cart-title title">My Cart</p>
            <div class="cart-body scroll-container">
                <div class="list-container">
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="list-item"> 
                        <div class="ItemImage">
                            <img src="../images/uploads/profiles/default.jpg" alt="">
                        </div>
                        <div class="ItemDetails">
                            <p class="ItemName">Food</p>
                            <p class="ItemPrice">₱ 2</p>
                        </div>
                        <div class="ItemQuantity">
                            <button>-</button>
                            <div>1</div>
                            <button>+</button>
                        </div>
                    </div>


       
                </div>
            </div>
            <div class="cart-footer">
                <hr>
                <div class="total">
                    <div class="total-items">Items: 141</div>
                    <div class="total-price">Amount: ₱ 132</div>
                </div>
                <hr>
                <div class="shipping">
                    <div class="stores">Stores: 2</div>
                    <div class="shipping-fee">Shipping Fee: ₱ 4142</div>
                    <div class="total-shipping-fee">Total Shipping Fee: ₱ 14124</div>
                </div>
                <hr>
                <div class="summary">
                    <div class="total-amount">Total: ₱ 132123</div>
                    <input type="text" name="" value="cavite, trece martires city">
                </div>
                <input type="submit" value="Order Now">
            </div>
        </div>
    </div>
</body>
</html>

