
<div class="d-flex justify-content-end topbar">
    <div class="topbar-logout-sec" id="popup-btn" onclick="LogOutFunction()">
        <a class="topbar-profile"><img src="#"></a>
        <a class="topbar-username">asd</a>
    </div>
</div>

<div class="sidebar close">
	<nav>
		<div class="sidebar-header">
			<div class="sidebar-logo">
				<a href="#" class="username"><img src="#" alt="" class="profile-side"></a>
			</div>
			<div class="sidebar-name">
				<span class="sidebar-name1">Systems Plus</span>
				<span class="sidebar-name1">Computer College</span>
			</div>
		</div>
		<i class='fas fa-bars toggle'></i>
	</nav>
	<div class="menu-bar">
		<div class="menu">
			<nav>
				<p><a href="#" class="username"><img src="#" alt="" class="profile-side"><span>Name</span></a></p>
				<ul>
				<li><a href="#"><i class="fas fa-desktop i"></i><span>Dashboard</span></a></li>
                <li><a href="#"><i class="fas fa-user i"></i><span>Students</span></a></li>
                <li><a href="#"><i class="fa fa-list-alt i"></i><span>Categories</span></a></li>
                <li><a href="#"><i class="fas fa-users i"></i><span>Users</span></a></li>
                <li><a href="#"><i class="fas fa-calendar-check i"></i><span>Evaluations</span></a></li>
                <li><a href="#"><i class="fas fa-chalkboard-teacher i"></i><span>Faculty</span></a></li>
                <li><a href="#"><i class="fas fa-question-circle i"></i><span>Question</span></a></li>
                <li><a href="#"><i class="fa fa-gear i"></i><span>Settings</span></a></li>
				<li><a href="?logout=true"><i class="fas fa-sign-out-alt i"></i><span>Sign Out</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>


<div class="popup-logout pop" id="popup">
    <div class="popup-logout-sec1">
        <img src="#" alt="" class="popup-profile">
        <p class="popup-name">Name</p>
        <p class="popup-student-number">20201125646</p>
    </div>
    <div class="popup-logout-sec2">
        <a href="#" class="popup-profile-button">Profile</a>
        <a href="#" class="popup-profile-logout" id="popup-profile-logout">Sign Out</a>
    </div>
</div>

<script>
	const sidebar = document.querySelector(".sidebar");
	const toggle = document.querySelector(".toggle");
	const logoutpop = document.getElementById('popup');
	

	toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});
$(document).ready(function () {
    document.onclick = function (div) {
        if (div.target.id !== 'popup' && div.target.id !== 'popup-btn') {
            logoutpop.style.display = "none";
        }
    }
});
function LogOutFunction() {
    if (logoutpop.style.display === "block") {
        logoutpop.style.display = "none";
    } else {
        logoutpop.style.display = "block";
    }
}

</script>