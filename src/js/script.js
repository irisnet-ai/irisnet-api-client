import 'code-prettify';

window.addEventListener("load", function() {

	// initiate code-prettify
	PR.prettyPrint();

	// handle tab clicks
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (var i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");
	}

	// toggle fieldset switches
	var fieldsetSwitches = document.querySelectorAll(".ui-toggle input[id*='_switch']");
	fieldsetSwitches.forEach(function(child) {

		var fieldsetName = child.id.slice(0, -7);
		if (child.id.includes('_param_switch'))
			fieldsetName = child.id.slice(0, -13);

		child.addEventListener("click", function(event) {

			var elem = document.querySelector(`fieldset[name=${fieldsetName}]`);
			elem.toggleAttribute('hidden');

			// reset or delete values of all children input fields when hidden
			if (elem.hasAttribute('hidden')) {
				elem.childNodes.forEach(function(child) {
					if (child.classList.contains('input-option')) {
						child.childNodes.forEach(function(c) {
							if (c.nodeName == "INPUT")
								c.value = '';
							else if(c.nodeName == "SELECT")
								c.selectedIndex = -1;
						});
					}
				});
			}

		});

	});
});