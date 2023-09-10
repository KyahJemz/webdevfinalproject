import { Helper } from './modules/helper.js';
import { Ajax } from './modules/ajax.js';
import { 
    Item, 
    Cart,
    fetchAllItems,
    AddItemToCart,
    GetItemsFromCart,
    ModifyItemQuantityFromCart
} from './class.js';

var Items = [];
var Carts = [];
var Category = [];

const helper = new Helper();

const CartListContainer = document.querySelector('.cart-list-container');
const HuntGridContainer = document.querySelector('.hunt-grid-container');
const CategoryListContainer = document.querySelector('.category-list-container');

function getRandomFromArray(array, count) {
    const shuffled = array.slice();
    let i = array.length;
    const results = [];
    while (i--) {
        const rand = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[rand]] = [shuffled[rand], shuffled[i]];
    }
    if (array.length <= count) {
        return shuffled;
    }
    for (let j = 0; j < count; j++) {
        results.push(shuffled[j]);
    }
    return results;
}

function getUniqueCategory() {
    const uniqueCategories = new Set();
    const newArray = [];

    Items.forEach(item => {
        if (item._ItemCategory) {
            if (!uniqueCategories.has(item._ItemCategory)) {
                uniqueCategories.add(item._ItemCategory);
                newArray.push(item._ItemCategory);
            }
        }
    });
    return newArray;
}

function setHuntDisplay(){
    let array = [];

    const filters = getFilteredCategory();
    if (filters.length > 0) {
        filters.forEach(filter => {
            Items.forEach(item => {
                if (filter === item._ItemCategory){
                    array.push(item);
                } 
            });
        });
    } else {
        array = Items;
    }

    const container = HuntGridContainer.querySelector('.grid-container');
    container.innerHTML = '';
    
    array.forEach(element => {
        let exist = false;
        Carts.forEach(cart => {
            if (element._ItemId === cart._itemId){
                exist = true;
            }
        });

        if (!exist) {
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('grid-item');
            itemDiv.setAttribute('data-itemid', element._ItemId);
            itemDiv.setAttribute('data-itemname', element._ItemName);
            itemDiv.setAttribute('data-itemcategory', element._ItemCategory);
            itemDiv.setAttribute('data-itemprice', element._ItemPrice);
            itemDiv.setAttribute('data-itemimage', element._ItemImage);
            itemDiv.setAttribute('data-StoreName', element._StoreName);
            itemDiv.setAttribute('data-StoreId', element._StoreId);
            itemDiv.setAttribute('data-StoreImage', element._StoreImage);
            itemDiv.setAttribute('data-StoreOwner', element._StoreOwner);
        
            itemDiv.innerHTML = `
                <div class="StoreName">${element._StoreName}</div>
                <div class="ItemImage"><img src="../images/uploads/items/${element._ItemImage}" alt=""></div>
                <div class="ItemName">${element._ItemName}</div>
                <div class="ItemCategory">${element._ItemCategory}</div>
                <div class="ItemPrice">${helper.formatPrice(element._ItemPrice)}</div>
                <div class="Button"><button>Add to cart</button></div>
            `;
            container.appendChild(itemDiv);
        }
    });
    helper.ElementsArrayAddClickListener(HuntGridContainer.querySelectorAll('.grid-item .Button button'), AddToCart);
}

function AddToCart(event){
    const element = event.currentTarget.parentNode.parentNode;
    const ItemId = element.dataset.itemid;

    const foundItem = Items.find(item => item._ItemId === ItemId);
    if (foundItem) {
        AddItemToCart(new Cart(foundItem.ItemId, foundItem.ItemName, foundItem.ItemPrice, foundItem.ItemImage, foundItem.StoreId, foundItem.StoreName, foundItem.StoreImage, '1'))
        setCartDisplay();
        setHuntDisplay();
    }
}

function setCategoryDisplay (){
    const CategoryList = getUniqueCategory();
    const container = CategoryListContainer.querySelector('.list-container');
    container.innerHTML = ``;
    CategoryList.forEach(element => {
        container.innerHTML = container.innerHTML + `<a data-category="${element}" class="category-button list-item">${element}</a>`;
    });
    bindCategoryListEventListeners();
}

function bindCategoryListEventListeners(){
    helper.ElementsArrayAddClickListener(CategoryListContainer.querySelectorAll('.list-item'), CategoryClick);
}

function CategoryClick(event){
    const CategoryElement = event.currentTarget;
    if(CategoryElement.classList.contains('selected')) {
        CategoryElement.classList.remove('selected');
    } else {
        CategoryElement.classList.add('selected');
    }
    setHuntDisplay();
}

function getFilteredCategory(){
    let array = [];
    const elements = CategoryListContainer.querySelectorAll('.selected');
    elements.forEach(element => {
        array.push(element.dataset.category);
    });
    return array;
}

function setCartDisplay() {
    const container = CartListContainer.querySelector('.list-container');
    container.innerHTML = '';
    let items = 0;
    let totalprice = 0;
    let stores = [];
    let shippingfee = 20;
    const uniqueCategories = new Set();    

    Carts=GetItemsFromCart();
    console.log(Carts);

    Carts.forEach(element => {
        items++;
        totalprice = totalprice + (Number(element._itemPrice) * Number(element._itemQuantity))

        if (!uniqueCategories.has(element._storeId)) {
            uniqueCategories.add(element._storeId);
            stores.push(element._storeId);
        }

        container.innerHTML += `
            <div class="list-item" data-itemid="${element._itemId}">
                <div class="ItemImage">
                    <img src="../images/uploads/items/${element._itemImage}" alt="">
                </div>
                <div class="ItemDetails">
                    <p class="ItemName">${element._itemName}</p>
                    <p class="ItemPrice">${helper.formatPrice(Number(element._itemPrice) * Number(element._itemQuantity))}</p>
                </div>
                <div class="ItemQuantity">
                    <button class="less-quantity">-</button>
                    <div>${element._itemQuantity}</div>
                    <button class="add-quantity">+</button>
                </div>
            </div>
        `;
    });

    CartListContainer.querySelector('.total-items').innerHTML = `Items: ${items}`;
    CartListContainer.querySelector('.total-price').innerHTML = `Amount: ${helper.formatPrice(totalprice)}`;
    CartListContainer.querySelector('.stores').innerHTML = `Stores: ${stores.length}`;
    CartListContainer.querySelector('.shipping-fee').innerHTML = `Shipping Fee: ${helper.formatPrice(shippingfee)}`;
    CartListContainer.querySelector('.total-shipping-fee').innerHTML = `Total Shipping Fee: ${helper.formatPrice(shippingfee * stores.length)}`;
    CartListContainer.querySelector('.total-amount').innerHTML = `Total: ${helper.formatPrice((shippingfee * stores.length) + totalprice)}`;
    CartListContainer.querySelector('.address').value = Address;

    localStorage.setItem('Carts', JSON.stringify(Carts));
    helper.ElementsArrayAddClickListener(CartListContainer.querySelectorAll('.less-quantity'),lessQuantityEvent);
    helper.ElementsArrayAddClickListener(CartListContainer.querySelectorAll('.add-quantity'),addQuantityEvent);
}

function lessQuantityEvent(event){
    const ItemId = event.currentTarget.parentNode.parentNode.dataset.itemid;
    if(ModifyItemQuantityFromCart('less',ItemId)){
        setCartDisplay();
    } else {
        setCartDisplay();
        setHuntDisplay();
    }
}
function addQuantityEvent(event){
    const ItemId = event.currentTarget.parentNode.parentNode.dataset.itemid;
    if (ModifyItemQuantityFromCart('add',ItemId)) {
        setCartDisplay();
        setHuntDisplay();
    }
}


(async () => {
    try {
        const fetchItems = await fetchAllItems(AccountId, AuthToken, StoreId);
        if (Array.isArray(fetchItems)) {
            fetchItems.forEach(element => {
                Items.push(new Item(
                    element['ItemId'],
                    element['ItemName'],
                    element['ItemCategory'],
                    element['ItemPrice'],
                    element['ItemImage'],
                    element['StoreId'],
                    element['StoreName'],
                    element['StoreImage'],
                    element['AccountId']
                ));
            });
            setCartDisplay();
            setCategoryDisplay();
            setHuntDisplay();
        } else {
            console.log('fetchItems is not an array.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
})();


function UploadOrder() {
    Upload()
    async function Upload(){       

        const list = GetItemsFromCart();
        const unique = new Set();
        let StoresId = [];

        let TransactionAmount = 0;
        let TransactionStatus = "complete";
        let TransactionOrders = JSON.stringify(list);
        let TransactionBuyer = AccountId;
        
        let TransactionBuyerAddress = document.querySelector('.cart-footer .address').value;


        list.forEach(item => {
            TransactionAmount = (Number(TransactionAmount) + (Number(item._itemPrice) * Number(item._itemQuantity)));

            if (item._storeId) {
                if (!unique.has(item._storeId)) {
                    unique.add(item._storeId);
                    StoresId.push(item._storeId);
                }
            }
        });

        let TransactionSeller = JSON.stringify(StoresId);

        console.log(TransactionAmount+"-"+
        TransactionStatus+"-"+
        TransactionOrders+"-"+
        TransactionBuyer+"-"+
        TransactionSeller+"-"+
        TransactionBuyerAddress);


        var formData = new FormData();
        formData.append('AuthToken', AuthToken);
        formData.append('AccountId', AccountId);
        formData.append('TransactionAmount', TransactionAmount);
        formData.append('TransactionStatus', TransactionStatus);
        formData.append('TransactionOrders', TransactionOrders);
        formData.append('TransactionBuyer', TransactionBuyer);
        formData.append('TransactionSeller', TransactionSeller);
        formData.append('TransactionBuyerAddress', TransactionBuyerAddress);
        formData.append('Intent', 'Insert Transaction');
        try {
            const responseJSON = await Ajax.postFormData('../php/api/transaction.php', formData);
            localStorage.clear();
            window.location.reload();
            return responseJSON;
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }
}
helper.ElementsAddClickListener(document.querySelector('.order-now-button'),UploadOrder);


