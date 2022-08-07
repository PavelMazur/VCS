function CustomValidation(input) {
	this.invalidities = [];
	this.validityChecks = [];
	this.inputNode = input;
	this.registerListener();
}

CustomValidation.prototype = {
	addInvalidity: function (message) {
		this.invalidities.push(message);
	},
	getInvalidities: function () {
		return this.invalidities.join('. \n');
	},
	checkValidity: function (input) {
		for (var i = 0; i < this.validityChecks.length; i++) {

			var isInvalid = this.validityChecks[i].isInvalid(input);
			if (isInvalid) {
				this.addInvalidity(this.validityChecks[i].invalidityMessage);
			}

			var requirementElement = this.validityChecks[i].element;
			if (requirementElement) {
				if (isInvalid) {
					requirementElement.classList.add('invalid');
					requirementElement.classList.remove('valid');
				} else {
					requirementElement.classList.remove('invalid');
					requirementElement.classList.add('valid');
				}
			}
		}
	},

	checkInput: function () {

		this.inputNode.CustomValidation.invalidities = [];
		this.checkValidity(this.inputNode);

		if (this.inputNode.CustomValidation.invalidities.length === 0 && this.inputNode.value !== '') {
			this.inputNode.setCustomValidity('');
		} else {
			var message = this.inputNode.CustomValidation.getInvalidities();
			this.inputNode.setCustomValidity(message);
		}
	},
	registerListener: function () {

		var CustomValidation = this;

		this.inputNode.addEventListener('keyup', function () {
			CustomValidation.checkInput();
		});
	}
};

var nameValidityChecks = [
	{
		isInvalid: function (input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'At least 3 characters',
		element: document.querySelector('label[for="name"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function (input) {
			return input.value.length > 15;
		},
		invalidityMessage: 'No more than 15 characters',
		element: document.querySelector('label[for="name"] .input-requirements li:nth-child(2)')
	},
	{
		isInvalid: function (input) {
			var illegalCharacters = input.value.match(/[^a-zA-ZĄ ą Č č Ę ę Ė ė Į į Š š Ų ų Ū ū Ž ž]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only letters can be typed',
		element: document.querySelector('label[for="name"] .input-requirements li:nth-child(3)')
	}
];

var surnameValidityChecks = [
	{
		isInvalid: function (input) {
			return input.value.length < 3;
		},
		invalidityMessage: 'At least 3 characters',
		element: document.querySelector('label[for="surname"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function (input) {
			var illegalCharacters = input.value.match(/[^a-zA-Z]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only letters can be typed',
		element: document.querySelector('label[for="surname"] .input-requirements li:nth-child(2)')
	}
];

var ageValidityChecks = [
	{
		isInvalid: function (input) {
			return input.value.length < 1;
		},
		invalidityMessage: 'At least 1 character',
		element: document.querySelector('label[for="age"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function (input) {
			return input.value.length > 5;
		},
		invalidityMessage: 'No more than 5 characters',
		element: document.querySelector('label[for="age"] .input-requirements li:nth-child(2)')
	},
	{
		isInvalid: function (input) {
			var illegalCharacters = input.value.match(/[^0-9.,]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only numbers can be typed',
		element: document.querySelector('label[for="age"] .input-requirements li:nth-child(3)')
	}
];

var heightValidityChecks = [
	{
		isInvalid: function (input) {
			return input.value.length < 1;
		},
		invalidityMessage: 'At least 1 character',
		element: document.querySelector('label[for="height"] .input-requirements li:nth-child(1)')
	},
	{
		isInvalid: function (input) {
			return input.value.length > 5;
		},
		invalidityMessage: 'No more than 5 characters',
		element: document.querySelector('label[for="height"] .input-requirements li:nth-child(2)')
	},
	{
		isInvalid: function (input) {
			var illegalCharacters = input.value.match(/[^0-9.{1},{1}]/g);
			return illegalCharacters ? true : false;
		},
		invalidityMessage: 'Only numbers can be typed',
		element: document.querySelector('label[for="height"] .input-requirements li:nth-child(3)')
	}
];

var nameInput = document.getElementById('name');
nameInput.CustomValidation = new CustomValidation(nameInput);
nameInput.CustomValidation.validityChecks = nameValidityChecks;

var surnameInput = document.getElementById('surname');
surnameInput.CustomValidation = new CustomValidation(surnameInput);
surnameInput.CustomValidation.validityChecks = surnameValidityChecks;

var ageInput = document.getElementById('age');
ageInput.CustomValidation = new CustomValidation(ageInput);
ageInput.CustomValidation.validityChecks = ageValidityChecks;

var heightInput = document.getElementById('height');
heightInput.CustomValidation = new CustomValidation(heightInput);
heightInput.CustomValidation.validityChecks = heightValidityChecks;

/* ----------------------------
	Event Listeners
---------------------------- */

var inputs = document.querySelectorAll('input:not([type="submit"])');
var submit = document.querySelector('input[type="submit"');
var form = document.getElementById('registration');

function validate() {
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].CustomValidation.checkInput();
	}
}

submit.addEventListener('click', validate);
form.addEventListener('submit', validate);


/* --------------------------------------------------
	FOR FUTURE ---> password validation <------
----------------------------------------------------- */


// var passwordValidityChecks = [
// 	{
// 		isInvalid: function(input) {
// 			return input.value.length < 8 | input.value.length > 100;
// 		},
// 		invalidityMessage: 'This input needs to be between 8 and 100 characters',
// 		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(1)')
// 	},
// 	{
// 		isInvalid: function(input) {
// 			return !input.value.match(/[0-9]/g);
// 		},
// 		invalidityMessage: 'At least 1 number is required',
// 		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(2)')
// 	},
// 	{
// 		isInvalid: function(input) {
// 			return !input.value.match(/[a-z]/g);
// 		},
// 		invalidityMessage: 'At least 1 lowercase letter is required',
// 		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(3)')
// 	},
// 	{
// 		isInvalid: function(input) {
// 			return !input.value.match(/[A-Z]/g);
// 		},
// 		invalidityMessage: 'At least 1 uppercase letter is required',
// 		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(4)')
// 	},
// 	{
// 		isInvalid: function(input) {
// 			return !input.value.match(/[\!\@\#\$\%\^\&\*]/g);
// 		},
// 		invalidityMessage: 'You need one of the required special characters',
// 		element: document.querySelector('label[for="password"] .input-requirements li:nth-child(5)')
// 	}
// ];

// var passwordRepeatValidityChecks = [
// 	{
// 		isInvalid: function() {
// 			return passwordRepeatInput.value != passwordInput.value;
// 		},
// 		invalidityMessage: 'This password needs to match the first one'
// 	}
// ];


// var passwordInput = document.getElementById('password');
// passwordInput.CustomValidation = new CustomValidation(passwordInput);
// passwordInput.CustomValidation.validityChecks = passwordValidityChecks;

// var passwordRepeatInput = document.getElementById('password_repeat');
// passwordRepeatInput.CustomValidation = new CustomValidation(passwordRepeatInput);
// passwordRepeatInput.CustomValidation.validityChecks = passwordRepeatValidityChecks;
