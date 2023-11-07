function Logout() {
  sessionStorage.removeItem("id");
  sessionStorage.removeItem("name");
  location.reload();
}
