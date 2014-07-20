
window.addEventListener("load", function load(event) {
	function iterate(node) {
		console.log(node.nodeName);
		for (var i in node.childNodes) {
			iterate(node.childNodes[i]);
		}
	}
	
	iterate(document.getElementsByTagName("body")[0])
	
}, false);


