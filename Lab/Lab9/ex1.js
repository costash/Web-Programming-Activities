console.log('Se execută scriptul');

var colors = ['red', 'green', 'blue', 'black'];

var getRandom = function(low, high) {
	return Math.floor((Math.random() * high) + low);
};
var changeColor = function() {
	var el = document.getElementById('hello');
	el.style.color = colors[getRandom(0, colors.length)];

};
setTimeout(changeColor, 200);
setInterval(changeColor, 200);

document.addEventListener('mousemove', function(e) {
	document.getElementById('posx').innerHTML = window.event.clientX;
	document.getElementById('posy').innerHTML = window.event.clientY;
});

function processForm(e) {
	if (e.preventDefault)
		e.preventDefault();

	/* do what you want with the form */
	var el = document.getElementById('qqq');
	console.log('Value of input is ' + el.value);

	// You must return false to prevent the default form behavior
	return false;
}

window.addEventListener("load", function load(event) {
	window.removeEventListener("load", load, false);
	//remove listener, no longer needed
	console.log("Fereastra s-a încărcat");

	var image = document.getElementById('image');

	image.onload = function() {
		console.log("Imaginea s-a încărcat");
	};

	image.src = 'http://agbeat.com/wp-content/uploads/2009/07/ag_sample_page_post_url.jpg';

	var form = document.getElementById('my-form');
	form.addEventListener("submit", processForm);

	var ul = document.createElement("ul");
	for (var i = 0; i < 10; ++i) {
		var li = document.createElement("li");
		li.textContent = "Math.Random()" + i;
		ul.appendChild(li);
	}
	document.body.appendChild(ul);

}, false);

