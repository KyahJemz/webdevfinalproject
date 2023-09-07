import { Helper } from './modules/helper.js';
import { Ajax } from './modules/ajax.js';
import { Item, Store, CartItem ,
    getMyItemsArray, addMyItemsArray, clearMyItemsArray

} from './class.js';


const helper = new Helper();

const ProfileMystoreContainer = document.getElementById('ProfileMystoreContainer');
const ProfileTransactionsContainer  = document.getElementById('ProfileTransactionsContainer');
const ProfileMystoreAddItemFormButton = document.getElementById('ProfileMyshopAddItemFormButton');
const ProfileMystoreAddStoreButton = document.getElementById('add-store-button');

// #############################################################################
// REFRESH LIST OF ITEMS
// #############################################################################
function ProfileMystoreRefreshList(){

    ProfileMystoreContainer.innerHTML = ``;

    ProfileMystoreContainer.innerHTML = `
        <div class="list-item add-item-form-container" style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 0px">
            <div class="bottom add-item-form" style="height: 0">
                <form id="form-add-item" style="border-top-width: 0px" action="../php/api/item.php" method="post" enctype="multipart/form-data">
                    <h3>Add Item Form</h3>
                    <fieldset><legend>Item Image:</legend><input name="ItemImage" class="add-image" type="file"></fieldset>
                    <fieldset><legend>Item Name:</legend><input name="ItemName" class="add-name" type="text"></fieldset>
                    <fieldset><legend>Item Category:</legend><input name="ItemCategory" class="add-category" type="text"></fieldset>
                    <fieldset><legend>Item Price:</legend><input name="ItemPrice" class="add-price" type="text"></fieldset>
                    <input id="add-item-button" class="add-button" type="submit" value="Add item">
                </form>
            </div>
        </div>
    `;

    setTimeout(() => {
        var formData = new FormData();
        formData.append('AuthToken', AuthToken);
        formData.append('AccountId', AccountId);
        formData.append('StoreId', StoreId);
        formData.append('Intent', 'Select MyItems');
        clearMyItemsArray();
        Ajax.postFormData('../php/api/item.php', formData)
        .then(responseJSON => {
            console.log(responseJSON); 
            responseJSON.forEach(item => {
                addMyItemsArray(item);
                ProfileMystoreContainer.innerHTML += `
                    <div class="list-item" data-id="${item.ItemId}" data-name="${item.ItemName}" data-category="${item.ItemCategory}" data-price="${item.ItemPrice}" data-image="${item.ItemImage}">
                        <div class="top">
                            <div class="item-image">
                                <img src="../images/uploads/items/${item.ItemImage}" alt="">
                            </div>
                            <div class="contents">
                                <p class="item-name">${item.ItemName}</p>
                                <p class="item-category">${item.ItemCategory}</p>
                                <p class="item-price">${item.ItemPrice}</p>
                            </div>
                            <div class="actions">
                                <div class="icons edit-button" title="Edit"></div>
                                <div class="icons delete-button" title="Delete"></div>
                            </div>
                        </div>
                        <div class="bottom" style="height: 0">
                            <form action="" method="">
                                <h3>Edit Item Form</h3>
                                <fieldset><legend>Item Image:</legend><input class="new-image" type="file"></fieldset>
                                <fieldset><legend>Item Name:</legend><input value="${item.ItemName}" class="new-name" type="text"></fieldset>
                                <fieldset><legend>Item Category:</legend><input value="${item.ItemCategory}" class="new-category" type="text"></fieldset>
                                <fieldset><legend>Item Price:</legend><input value="${item.ItemPrice}" class="new-price" type="text"></fieldset>
                                <input class="update-button" type="button" value="Update changes">
                            </form>
                        </div>
                    </div>
                `;

            });
            bindProfileMyshopContainerButtons ();
        })
        .catch(error => {
            console.error('Error:', error); // Log the error message and object
        });
    }, 1000);
}


// #############################################################################
// SHOW ADD ITEM FORM
// #############################################################################
helper.ElementsAddClickListener(ProfileMystoreAddItemFormButton,ProfileMystoreAddItemForm);
function ProfileMystoreAddItemForm(event){
    const container = event.currentTarget.parentNode.parentNode.querySelector('.add-item-form-container');
    const element = event.currentTarget.parentNode.parentNode.querySelector('.add-item-form');

    if (element.style.visibility === 'hidden' || element.style.visibility === '') {
        element.style.visibility = 'visible';
        element.style.height = 'fit-content';
        container.style.paddingTop = '6px'
        container.style.paddingBottom = '6px'
        container.style.marginBottom = '10px'
    } else {
        element.style.visibility = 'hidden';
        element.style.height = '0px';
        container.style.paddingTop = '0px'
        container.style.paddingBottom= '0px'
        container.style.marginBottom = '0px'
    }
}



// #############################################################################
// ADD SHOP API
// #############################################################################
helper.ElementsAddClickListener(ProfileMystoreAddStoreButton,ProfileMystoreAddShop);
function ProfileMystoreAddShop(event){
    event.preventDefault();
    const formData = new FormData(event.currentTarget.parentNode);

    formData.append('Username', Username);
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('Intent', 'Insert Store');

    Ajax.postFormData('../php/api/store.php',formData)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    }).then(ProfileMystoreRefreshList())
    .catch(error => {
        console.error(error);
    });
}



// #############################################################################
// ADD ITEM API
// #############################################################################
function ProfileMystoreAddItem(event){
    event.preventDefault();
    const formData = new FormData(event.currentTarget.parentNode);
    formData.append('StoreId', StoreId);
    formData.append('AuthToken', AuthToken);
    formData.append('AccountId', AccountId);
    formData.append('Intent', "Insert Item");

    Ajax.postFormData('../php/api/item.php',formData)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    }).then(ProfileMystoreRefreshList())
    .catch(error => {
        console.error(error);
    });
}


// #############################################################################
// DELETE ITEM API
// #############################################################################
function ProfileMyshopDeleteItem(event){
    const element = event.currentTarget.parentNode.parentNode.parentNode.querySelector('.bottom');
    const itemId = event.currentTarget.parentNode.parentNode.parentNode.dataset.id;
    console.log("Deleting: " + itemId);
}



// #############################################################################
// SHOW EDIT FORM
// #############################################################################
function ProfileMyshopEditForm(event){
    const element = event.currentTarget.parentNode.parentNode.parentNode.querySelector('.bottom');
    if (element.style.visibility === 'hidden' || element.style.visibility === '') {
        element.style.visibility = 'visible';
        element.style.height = 'fit-content';
    } else {
        element.style.visibility = 'hidden';
        element.style.height = '0px';
    }
}



// #############################################################################
// UPDATE ITEM API
// #############################################################################
function ProfileMyshopUpdateItem(event){
    const element = helper.SelectClassWith(event.currentTarget.parentNode.parentNode.parentNode, '.bottom');
    const itemId = event.currentTarget.parentNode.parentNode.parentNode.dataset.id;
    const newImage = helper.SelectClassWith(element,'.new-image');
    const newName = helper.SelectClassWith(element,'.new-name');
    const newCategory = helper.SelectClassWith(element,'.new-cantegory');
    const newPrice = helper.SelectClassWith(element,'.new-price');
    if (newImage)
    console.log("Updating: " + itemId);
}


// #############################################################################
// BIND ALL LIST BUTTONS
// #############################################################################
function bindProfileMyshopContainerButtons () {
    const DeleteButtons = helper.SelectAllClassWith(ProfileMystoreContainer, '.delete-button');
    const EditButtons = helper.SelectAllClassWith(ProfileMystoreContainer, '.edit-button');
    const UpdateButtons = helper.SelectAllClassWith(ProfileMystoreContainer, '.update-button');
    const AddItemButtons = document.getElementById('add-item-button');

    helper.ElementsArrayAddClickListener(DeleteButtons,ProfileMyshopDeleteItem);
    helper.ElementsArrayAddClickListener(EditButtons,ProfileMyshopEditForm);
    helper.ElementsArrayAddClickListener(UpdateButtons,ProfileMyshopUpdateItem);
    helper.ElementsAddClickListener(AddItemButtons,ProfileMystoreAddItem);
}


ProfileMystoreRefreshList();
