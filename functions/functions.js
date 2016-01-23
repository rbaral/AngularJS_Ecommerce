function callModalSendMessage(fromEmail, toEmail, Subject){
	$('#mMsgFrom').val(fromEmail);
	$('#mMsgTo').val(toEmail);
	$('#mMsgSubject').val(Subject);
	$('#mSendMsg').modal('show');
}

//////////////////////////////AJAX///////////////////////////////////
//Insert Functions.
function insert_new_user(fname, mname, lname, address, phoneNumber, email, password){
	$.ajax({
	  type: "POST",
	  url: "database/Insert_new_user.php",
	  data: { 
	  fName: fname, 
	  mName: mname,
	  lName: lname, 
	  Address: address,
	  pNumber: phoneNumber,
	  Email: email,
	  Password: password}
	})
	  .done(function( msg ) {
		//console.log(msg);
		if(msg == true){
			$('#titleWSignUPInfo').text("SuccessFul Sign Up");
			$('#tWSignUPInfo').text("Thank you for signing up, now you can login into your account.");
			$('#mWSignUPInfo').modal('show');
			show_Page(0);
		}else{
			$('#titleWSignUPInfo').text("Un-SuccessFul Sign Up");
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}
	  });
}

function insert_new_msg(email, to, subject, msg, status, moveTo){
	$.ajax({
	  type: "POST",
	  url: "database/Insert_new_msg.php",
	  data: { 
	  FromEmail: email,
	  ToEmail: to,
	  Subject: subject,
	  Msg: msg,
	  status: status}
	})
	  .done(function( msg ) {
		if(msg == true && status==true){
			$('#titleWSignUPInfo').text("Email Sent");
			$('#tWSignUPInfo').text("Thank you for sending us the feedback");
			$('#mWSignUPInfo').modal('show');
			if (moveTo != -1) show_Page(moveTo);
		}else if(msg == false && status==true){
			$('#titleWSignUPInfo').text("Email not sent");
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}else{
			if (moveTo != -1) show_Page(moveTo);
		}
	  });
}

function insert_new_item(itemname, itemdescription, itembuynowprice,itembidprice, itemqty, itempics, itemweight, itemdimension, pckgdimension, itemtype,itemcategory, startdate, enddate){
	
	if(itemtype == 'bid'){
	itemprice = itembidprice;
	itemqty = 1;
	}else itemprice = itembuynowprice;
	//alert("itemname:"+ itemname+ " itemdescription"+ itemdescription+ " itemprice"+ itemprice+ " itemqty"+ itemqty+" itempics"+ itempics+" itemweight"+ itemweight+" pckgdimension"+ pckgdimension+" itemdimension"+ itemdimension+" itemcategory"+ itemcategory+ " startdate"+ startdate+ " enddate"+ enddate+ " itemtype"+ itemtype);
	
	$.ajax({
	  type: "POST",
	  url: "database/Insert_new_item.php",
	  data: { 
	  Email: userInfo['Email'],
	  itemname: itemname,
	  itemdescription: itemdescription, 
	  itemprice: itemprice,
	  itemqty: itemqty,
	  itempics: itempics,
	  itemweight: itemweight,
	  pckgdimension: pckgdimension,
	  itemdimension: itemdimension,
	  itemcategory: itemcategory,
	  startdate: startdate,
	  enddate: enddate,
	  itemtype: itemtype}
	})
	  .done(function( msg ) {
	     //console.log(msg);
		if(msg == true){
			accnt_item_sold('today', 'nextmonth');
		}else{
			$('#titleWSignUPInfo').text("Un-SuccessFul Request");
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}
	  });

}

function insert_in_shoppingCart(itemId, Price, Qty){
	$.ajax({
	  type: "POST",
	  url: "database/insertInShoppingCart.php",
	  data: { 
	  itemid: itemId,
	  price: Price, 
	  qty: Qty,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
		  alert("added item "+itemId+" >>>"+Qty+" pieces,at price:"+Price);
	  });
}

function insert_a_bid(itemId, Price, Time){
	$.ajax({
	  type: "POST",
	  url: "database/Insert_bid.php",
	  data: { 
	  itemid: itemId,
	  price: Price, 
	  time: Time,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
		//show_Page(0);
	  });
}

/*
 * TODOS
 * 1) send email from mysql?
 * 2) scheduler to place system bids
 * 3) payment method integration
 * 
 */

//bid related functions
function doBid(bidID, bidAmount){
	$.ajax({
		  type: "POST",
		  url: "database/Insert_bid.php",
		  data: {
		  Email: userInfo['Email'],
		  bidID:bidID,
		  userbidAmount:bidAmount,
		  bidType:'userBid'
		  }
		})
		  .done(function( msg ) {
			  alert(msg);
			if(msg == true){
				alert(msg);
			}else{
				//$('#titleWSignUPInfo').text("Limited time sale not added");
				//$('#tWSignUPInfo').text(msg);
				//$('#mWSignUPInfo').modal('show');
			}
		  });
}


function insert_category(name, description){
	$.ajax({
	  type: "POST",
	  url: "database/Insert_category.php",
	  data: { 
	  name: name,
	  description: description,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
		if(msg == true){
			accnt_search_categories(-1);
			show_Page(17);
		}else{
			$('#titleWSignUPInfo').text("Un-SuccessFul Request");
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}
	  });
}

function insert_LTSale(itemName, price, startDate, endDate, qty){
	$.ajax({
	  type: "POST",
	  url: "database/Insert_LTSale.php",
	  data: { 
	  itemName: itemName,
	  price: price,
	  startDate: startDate,
	  endDate: endDate,
	  qty: qty}
	})
	  .done(function( msg ) {
		if(msg == true){
			accnt_limitedTSale('from', 'to');
			show_Page(11);
		}else{
			$('#titleWSignUPInfo').text("Limited time sale not added");
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}
	  });
}


//Select Functions
var ShoppingCart;
function accnt_shoppingCart(){
	$.ajax({
	  type: "POST",
	  url: "database/accntShoppingCart.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    i=0;
	    ShoppingCart = msg;
			var $scope = angular.element($("#shoppingCart")).scope();
	   		$scope.$apply(function(){
				$scope.shoppingCart = new Array();
				$scope.shoppingCart = ShoppingCart;
				$scope.total=0*1;
				for (i = 0; i < $scope.shoppingCart.length; i++) {
					$scope.total+= ($scope.shoppingCart[i].Total)*1;
				}
    		});
			
			var $scope = angular.element($("#checkout")).scope();
	   		$scope.$apply(function(){
				$scope.shoppingCart = new Array();
				$scope.shoppingCart = ShoppingCart;
				$scope.total=0*1;
				for (i = 0; i < $scope.shoppingCart.length; i++) {
					$scope.total+= ($scope.shoppingCart[i].Total)*1;
				}
    		});
		//alert(accountSumary['unreadEmail']);
	    show_Page(18);
	  });
}

function update_ShoppingCart(cartid, pid, Qty){
	$.ajax({
	  type: "POST",
	  url: "database/Update_ShoppingCartItem.php",
	  data: { 
	  scid: cartid,
	  pid:	pid,
	  qty: Qty,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
		if(msg)
			accnt_shoppingCart();
	  });
}

//deletes item from shopping cart

function delete_ShoppingCart(cartid, pid){
	$.ajax({
	  type: "POST",
	  url: "database/delete_ShoppingCartItem.php",
	  data: { 
	  scid: cartid,
	  pid:	pid,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
		if(msg)
			accnt_shoppingCart();
	  });
}

var oneUser;
function searchOneUser(Email){
	if(Email == userInfo['Email']){
		$('#titleWSignUPInfo').text("Wrong Email");		
		$('#tWSignUPInfo').text("Sorry, Due to Security Issues, you cannot modify your own account.");
		$('#mWSignUPInfo').modal('show');
	}else{
		$.ajax({
		  type: "POST",
		  url: "database/accntSearchUser.php",
		  data: { 
		  email: Email}
		})
		.done(function( msg ) {
			oneUser = msg;
			
			//console.log(oneUser);
			if(oneUser == null){
				$('#titleWSignUPInfo').text("Wrong Email");		
				$('#tWSignUPInfo').text("Check the email of the user you are looking for and try again.");
				$('#mWSignUPInfo').modal('show');
			}else{
			//console.log(oneUser);
			var $scope = angular.element($("#userOneMng")).scope();
				$scope.$apply(function(){
					$scope.oneUser = new Array();
					$scope.oneUser = oneUser;
					show_Page(21);
				});
			}
		});
	}
}

var userInfo;
function login(Email, Password){
	//alert(Email+" "+Password);
	$.ajax({
	  type: "POST",
	  url: "database/accntLogin.php",
	  data: { 
	  email: Email,
	  password: Password}
	})
	  .done(function( msg ) {
	  //if credentials match
		//alert("here");
		//console.log(msg);
		userInfo = msg;
		$('#exampleInputPassword1').val('');
		
		//console.log(userInfo);
		if((userInfo == null) || (!(typeof userInfo==='object'))){
			$('#titleWSignUPInfo').text("Login Un-SuccessFul");		
			$('#tWSignUPInfo').text(msg);
			$('#mWSignUPInfo').modal('show');
		}else{
		//console.log(userInfo);
		var $scope = angular.element($("#accntMenu")).scope();
	   		$scope.$apply(function(){
				$scope.userinfo = new Array();
				$scope.userinfo = userInfo; 
		});
		accnt_sumary();
	  }});
}

function logOut(){
	$.ajax({
	  type: "POST",
	  url: "database/accntLogOut.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    //alert(msg);
		userInfo = null;
	    show_Page(8);
	  });
}

var accountSumary;
function accnt_sumary(){
	$.ajax({
	  type: "POST",
	  url: "database/accnt_sumary.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    accountSumary = msg;
			var $scope = angular.element($("#userMainSum")).scope();
	   		$scope.$apply(function(){
				$scope.accntSumary = new Array();
				$scope.accntSumary = accountSumary;
    		});

		//alert(accountSumary['unreadEmail']);
	    show_Page(7);
	  });
}

var accountLTSale;
function accnt_limitedTSale(from, to){
	$.ajax({
	  type: "POST",
	  url: "database/accntLTSItems.php",
	  data: { 
	  from: from,
	  to: to,
	  email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    accountLTSale = msg;
		//console.log(accountLTSale);
			var $scope = angular.element($("#LTSItems")).scope();
	   		$scope.$apply(function(){
				$scope.limitedTs = new Array();
				$scope.limitedTs = accountLTSale;
    		});

		//alert(accountSumary['unreadEmail']);
	  });
}

var accountDetail;
function accnt_detail(){
	$.ajax({
	  type: "POST",
	  url: "database/accnt_details.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    accountDetail = msg;
			var $scope = angular.element($("#userMainDtail")).scope();
	   		$scope.$apply(function(){
				$scope.accountDtl = new Array();
				$scope.accountDtl = accountDetail;
    		});
		//alert(accountDetail['FirstName']);
		show_Page(12);
	  });
}

var accountMsg;
function accnt_msg(){
//alert("here");
	$.ajax({
	  type: "POST",
	  url: "database/accnt_msg.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	  		//console.log(msg);
	    accountMsg = msg;
			var $scope = angular.element($("#userMainMsg")).scope();
	   		$scope.$apply(function(){
				$scope.msgs = new Array();
				$scope.msgs = accountMsg;
    		});
			//alert(accountMsg[0]['status']);
		show_Page(13);
	  });
}

/*
var accountOneMsg;
function accnt_One_msg(emailNo){
alert(emailNo);
	$.ajax({
	  type: "POST",
	  url: "database/accnt_One_msg.php",
	  data: { 
	  Email: userInfo['Email'],
	  EmailNo: emailNo}
	})
	  .done(function( msg ) {
	    accountOneMsg = msg;
			var $scope = angular.element($("#userOneMsg")).scope();
	   		$scope.$apply(function(){
				$scope.oneMsg = new Array();
				$scope.oneMsg = accountOneMsg;
    		});
		//alert(accountOneMsg['Subject']);
		show_Page(14);
	  });
}
*/

var accntItemsActive;
function accnt_item_active(){
	$.ajax({
	  type: "POST",
	  url: "database/accntItemsActive.php",
	  data: { 
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	    accntItemsActive = msg;
			var $scope = angular.element($("#activeItems")).scope();
	   		$scope.$apply(function(){
				$scope.accntItemActive = new Array();
				$scope.accntItemActive = accntItemsActive;
				//alert($scope.accntItemActive[0]['itemType']);
    		});
		//alert(accntItemsActive[0]['itemType']);
		//show_Page(11);
	  });
}

var accntItemsBought;
function accnt_item_bought(from, to){
	$.ajax({
	  type: "POST",
	  url: "database/accntItemsBought.php",
	  data: { 
	  Email: userInfo['Email'],
	  From: from,
	  To: to}
	})
	  .done(function( msg ) {
	  //if credentials match
	    accntItemsBought = msg;
			var $scope = angular.element($("#userMainBuy")).scope();
	   		$scope.$apply(function(){
				$scope.accntbought = new Array();
				$scope.accntbought = accntItemsBought;
				$scope.email = userInfo['Email'];
    		});
		//alert(accntItemsBought[0]['itemNo'])
		show_Page(10);
	  });
}

var accntItemsSold;
function accnt_item_sold(from, to){
	$.ajax({
	  type: "POST",
	  url: "database/accntItemsSold.php",
	  data: { 
	  Email: userInfo['Email'],
	  From: from,
	  To: to}
	})
	  .done(function( msg ) {
	    accntItemsSold = msg;
			var $scope = angular.element($("#soldItems")).scope();
	   		$scope.$apply(function(){
				$scope.accntsold = new Array();
				$scope.accntsold = accntItemsSold;
    		});
		//alert($scope.accntsold[0]['itemName']);
		show_Page(11);
	  });
}

var searchCategories;//done checking
function accnt_search_categories(moveToPage){
	$.ajax({
	  type: "POST",
	  url: "database/accntSearchCategories.php",
	  data: {}
	})
	  .done(function( msg ) {
	    searchCategories = msg;
		if (moveToPage !=-1 ){
			var $scope = angular.element($("#searchCategory")).scope();
	   		$scope.$apply(function(){
				$scope.searchCategories = new Array();
				$scope.searchCategories = searchCategories;
    		});
			show_Page(moveToPage);
		}else{
			var $scope = angular.element($("#newItemSale")).scope();
	   		$scope.$apply(function(){
				$scope.searchCategories = new Array();
				$scope.searchCategories = searchCategories;
    		});		
		}
		//alert(searchCategories[0]['Category'])
	  });
}

var accntSearchResult;
var recentSearch = new Array();
recentSearch['name'] = null;
recentSearch['categID'] = null;
recentSearch['sortby'] = null;
recentSearch['format'] = null;
function accnt_search_result(name, categID, sortby, format){
	recentSearch['name'] = categID;
	recentSearch['categID'] = categID;
	recentSearch['sortby'] = sortby;
	recentSearch['format'] = format;
	$.ajax({
	  type: "POST",
	  url: "database/accntSearchResult.php",
	  data: { 
	  Name: name,
	  CategoriesId : categID,
	  Format: format,
	  Sortby: sortby}
	})
	  .done(function( msg ) {
	    accntSearchResult = msg;
			var $scope = angular.element($("#searchResult")).scope();
	   		$scope.$apply(function(){
				$scope.searchResult = new Array();
				$scope.searchResult = accntSearchResult;
    		});
		
		//alert(accntSearchResult[1]['itemFormat']);
		show_Page(16);
	  });
}

//Update Functions
function update_accnt_detail(fName, lName, Address){
	$.ajax({
	  type: "POST",
	  url: "database/Update_accnt_details.php",
	  data: { 
	  Email: userInfo['Email'],
	  fName : fName,
	  lName : lName,
	  Address : Address}
	})
	  .done(function( msg ) {
	  //if credentials match
	    accountDetail = msg;
		show_Page(12);
	  });
}

function update_item(itemno, itemname, itemdescription, itemprice, itemqty, itempics, itemweight, itemdimension, itemtype){
	$.ajax({
	  type: "POST",
	  url: "database/Update_item.php",
	  data: { 
	  Email: userInfo['Email'],
	  itemno: itemno,
	  itemname: itemname,
	  itemdescription: itemdescription, 
	  itemprice: itemprice,
	  itemqty: itemqty,
	  Password: itempics,
	  itemweight: itemweight,
	  itemdimension: itemdimension,
	  itemtype: itemtype}
	})
	  .done(function( msg ) {
		show_Page(11);
	  });
}

function update_user_role(email, role){
	//alert(email+"   "+role);
	$.ajax({
	  type: "POST",
	  url: "database/Update_userRole.php",
	  data: { 
	  userEmail: email,
	  Email: userInfo['Email'],
	  Role: role}
	})
	  .done(function( msg ) {
	  //console.log(msg);
	  //alert("here");
	  if(msg == true){
		$('#titleWSignUPInfo').text("Success");		
		$('#tWSignUPInfo').text("The "+ email +" account role has been updated.");
		$('#mWSignUPInfo').modal('show');
		}else{
		$('#titleWSignUPInfo').text("Error");		
		$('#tWSignUPInfo').text("There has been an error and the "+ email +" account role has not been updated");
		$('#mWSignUPInfo').modal('show');
		}
		show_Page(20);
	  });
}

//Delete Functions
function delete_user(email){
	$.ajax({
	  type: "POST",
	  url: "database/Delete_userAccnt.php",
	  data: { 
	  userEmail: email,
	  Email: userInfo['Email']}
	})
	  .done(function( msg ) {
	  if(msg == true){
		$('#titleWSignUPInfo').text("Success");		
		$('#tWSignUPInfo').text("The "+ email +" account has been deleted.");
		$('#mWSignUPInfo').modal('show');
		}else{
		$('#titleWSignUPInfo').text("Error");		
		$('#tWSignUPInfo').text("There has been an error and the "+ email +" account has not been deleted");
		$('#mWSignUPInfo').modal('show');
		}
		show_Page(20);
	  });
}


////////////////////////////ANGULAR JS///////////////////////////////
/*
function carouselImages($scope) {
	$scope.imgList = Array();
	$scope.imgList[0] = "img/images1.jpg";
	$scope.imgList[1] = "img/images2.jpg";
	$scope.imgList[2] = "img/images3.jpg";
	$scope.imgList[3] = "img/index2.jpg";
	$scope.imgShow = 0;

	
	$scope.changeImg = function(index){
		$scope.imgShow = index;   
	}
	
	$scope.changeImgNext = function(){
		if ( $scope.imgShow < $scope.imgList.length-1 ) $scope.imgShow++;
		else $scope.imgShow = 0;
	}
	
}
*/
var myapp = angular.module('invoiceListModule', []);


myapp.controller('AccntLTSController', function($scope) {
    $scope.limitedTs = new Array();
});

myapp.controller('AccntSearchController', function($scope) {
    $scope.searchCategories = new Array();
}); 

myapp.controller('AccntOneUserController', function($scope) {
    $scope.oneUser = new Array();
});

myapp.controller('AccntUserInfoController', function($scope) {
    $scope.userinfo = new Array();
});

myapp.controller('AccntShoppingCartController', function($scope) {
	$scope.names = ['pizza', 'unicorns', 'robots'];
    $scope.my = { favorite: 'unicorns' };
    $scope.shoppingCart = new Array();
    $scope.qtyOut = Array();
	$scope.total = 0;
	$scope.update_ShoppingCart= function(cartid,pid,index){
		alert(cartid+" "+pid+" ..index is:"+index+".."+$scope.qtyOut[index]);
		//if ($scope.qtyOut[index] != undefined)
		//	alert($scope.qtyOut[index]);
		//else 
			//alert("it is not valid number");
		//var elem=angular.element('qty_'+qty);
	    //var elem = angular.element(qty.srcElement);
	    //   elem.css('background', 'blue');
	    //   alert(elem.attr('id')+"..."+elem.attr('value'));
		update_ShoppingCart(cartid, pid, $scope.qtyOut[index]);
	}
	$scope.delete_ShoppingCart= function(cartid,pid){
		alert("deleting item with cartid"+cartid+" and product "+pid);
		delete_ShoppingCart(cartid, pid);
	}
	
});

myapp.controller('AccntSearchResultController', function($scope) {
    $scope.searchResult = new Array();

	var accntOneItem;
	$scope.accnt_one_item = function(itemNo){
		if(userInfo == null){
			$('#mneedSignUP').modal('show');
		}else{
			$.ajax({
			  type: "POST",
			  url: "database/accntOneItem.php",
			  data: { 
			  Email: userInfo['Email'],
			  itemNo: itemNo}
			})
			  .done(function( msg ) {
				accntOneItem = msg;
				var $scope = angular.element($("#itemSale")).scope();
				$scope.$apply(function(){
					$scope.oneItem = new Array();
					$scope.oneItem = accntOneItem;
					
					//countdown set up
					$dateNow = new Date();
					$dateEnd = new Date(2014, 10, 1, 3, 59, 59);
					$seconds = Math.floor(($dateEnd.getTime() - $dateNow.getTime()) / 1000);
					
					// Calculate seconds, minutes, hours, days
					if ( $seconds < 0 )
					{
						$scope.dd = 0;
						$scope.hh = 0;
						$scope.mm = 0;
						$scope.ss = 0;
					}
					else
					{
						$scope.dd = Math.floor(($seconds % 31536000) / 86400);
						$scope.hh = Math.floor((($seconds % 31536000) % 86400) / 3600);
						$scope.mm = Math.floor(((($seconds % 31536000) % 86400) % 3600) / 60);
						$scope.ss = Math.floor (((($seconds % 31536000) % 86400) % 3600) % 60);
					}
					//countdown
					$scope.stop();
					$scope.countdown($scope.mm, $scope.dd, $scope.hh, $scope.ss);
					//$('.carousel').carousel();
				});

				show_Page(15);
			  });
		}
	}
});

myapp.controller('AccntSummaryController', function($scope) {
    $scope.accntSumary = new Array();
}); 

myapp.controller('AccntBoughtController', function($scope) {
    $scope.accntbought = new Array();
	$scope.email = '';

	$scope.callModalSendMessage = function(fromEmail, toEmail, Subject){
	$('#mMsgFrom').val(fromEmail);
	$('#mMsgTo').val(toEmail);
	$('#mMsgSubject').val(Subject);
	$('#mSendMsg').modal('show');
}

}); 

myapp.controller('AccntsoldController', function($scope) {
    $scope.accntsold = new Array();
	
	$scope.callModalSendMessage = function(fromEmail, toEmail, Subject){
	$('#mMsgFrom').val(fromEmail);
	$('#mMsgTo').val(toEmail);
	$('#mMsgSubject').val(Subject);
	$('#mSendMsg').modal('show');
	}
}); 

myapp.controller('AccntItemActiveController', function($scope) {
    $scope.accntItemActive = new Array();
}); 

myapp.controller('AccntDetailsController', function($scope) {
    $scope.accountDtl = new Array();
}); 

myapp.controller('AccntMsgsController', function($scope) {
    $scope.msgs = new Array();
	
	var accountOneMsg;
	$scope.accnt_One_msg = function(emailNo){
	$.ajax({
	  type: "POST",
	  url: "database/accnt_One_msg.php",
	  data: { 
	  Email: userInfo['Email'],
	  EmailNo: emailNo}
	})
	  .done(function( msg ) {
	    accountOneMsg = msg;
			var $scope = angular.element($("#userOneMsg")).scope();
	   		$scope.$apply(function(){
				$scope.oneMsg = new Array();
				$scope.oneMsg = accountOneMsg;
    		});
		//alert(accountOneMsg['Subject']);
		show_Page(14);
	  });
	}
}); 

myapp.controller('AccntOneMsgController', function($scope) {
    $scope.oneMsg = new Array();
	
	$scope.delete_msg = function(emailNo){
	$.ajax({
	  type: "POST",
	  url: "database/Delete_msg.php",
	  data: { 
	  emailNo: emailNo,
	  email: userInfo['Email']}
	})
	  .done(function( msg ) {
	  if(msg == true){
		$('#titleWSignUPInfo').text("Success");		
		$('#tWSignUPInfo').text("The email has been deleted.");
		$('#mWSignUPInfo').modal('show');
		}else{
		$('#titleWSignUPInfo').text("Error");		
		$('#tWSignUPInfo').text("There has been an error and the email has not been deleted");
		$('#mWSignUPInfo').modal('show');
		}
		accnt_msg();
	  })};
	  
	$scope.callModalSendMessage = function(fromEmail, toEmail, Subject){
	$('#mMsgFrom').val(fromEmail);
	$('#mMsgTo').val(toEmail);
	$('#mMsgSubject').val(Subject);
	$('#mSendMsg').modal('show');
	}
}); 

myapp.controller('AccntNewItemController', function($scope) {
    $scope.itemType = new Array();
	$scope.itemType['option'] = 'Select a category';
	$scope.itemType['option'] = 'buy now';
	$scope.itemType['option'] = 'bid';	
});

myapp.controller("AccntOneItemController",['$scope','$timeout', function($scope,$timeout){
	$scope.oneItem = new Array();
	$scope.dd = 0;
	$scope.hh = 0;
	$scope.mm = 0;
	$scope.ss = 0;
	$scope.purchaseQuantity=0;//by default it is 0
	$scope.bidAmount=0;// by default it is 0
	var stopped;
	$scope.imgShow = 0;

	$scope.changeImg = function(index){
		$scope.imgShow = index;   
	}
	
	$scope.changeImgNext = function(){
		if ( $scope.imgShow < $scope.imgList.length-1 ) $scope.imgShow++;
		else $scope.imgShow = 0;
	}
	
	$scope.addItemToCart=function(prodID, price){
		alert("adding item "+prodID+" >>>"+$scope.purchaseQuantity+" pieces,at price:"+price);
		if($scope.purchaseQuantity < 1){
			alert("You must select valid quantity");
			//return false;
		}else{
			insert_in_shoppingCart(prodID, price, $scope.purchaseQuantity);
		}

	};
	
	$scope.doBid= function(bidID, bidAmount){
		alert("placing bid on bidID:"+bidID+" bid amt:"+bidAmount+".. minbid was:"+$scope.oneItem.nextMinBid);
		if(bidAmount < $scope.oneItem.nextMinBid){
			alert("You nead to bid at least "+$scope.oneItem.nextMinBid);
			//return false;
		}else{
			doBid(bidID, bidAmount);
		}
	};
		
	$scope.countdown = function(month, day, hour, sec) {
		$scope.dd = day;
		$scope.hh = hour;
		$scope.mm = month;
		$scope.ss = sec;
		
		stopped = $timeout(function() {
		if ($scope.dd + $scope.hh + $scope.mm + $scope.ss <= 0)  
			stop();
		else 
		{
			 if ( $scope.ss == 0 )
			 {
					$scope.ss = 59;
					/* Minutes */
					if ($scope.mm == 0 )
					{	
						/* Hours */
						if ( $scope.hh == 0)
						{
							$scope.hh = 23;
							$scope.dd--;
						}
						else $scope.hh --;
						$scope.mm = 59;
					}	
					else $scope.mm --;
			 }
			 else $scope.ss--; 
			 if ( ($scope.dd != 0) || ($scope.hh != 0) || ($scope.mm != 0) || ($scope.ss != 0) ) $scope.countdown($scope.mm, $scope.dd, $scope.hh, $scope.ss)
			 else stop();
		}
		}, 1000);
	  };
	   
		
	$scope.stop = function(){
		$timeout.cancel(stopped);
		} 
}]);

///
