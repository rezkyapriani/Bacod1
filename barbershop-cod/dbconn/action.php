<?php
session_start();
require 'koneksi.php';
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$email = stripcslashes($email);
	$password = stripcslashes($password);
	$email = mysql_escape_string($email);
	$password = mysql_escape_string($password);

	$sql = 'select * from pelanggan where EMAIL="'.$email.'" and PASSWORD="'.$password.'"';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$_SESSION['email']=$email;
		header('location: ../index.php');
	}
	else header('location: ../login.php');
	$conn->close();
}
else if (isset($_POST['sign_up'])) {
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$telephone = $_POST['telephone'];

	$sql = 'select * from pelanggan where EMAIL="'.$email.'" or PASSWORD="'.$password.'"';
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
		$sql = 'insert into pelanggan values ("","'.$nama.'","'.$alamat.'","'.$telephone.'","'.$email.'","'.$password.'",now())';
		$conn->query($sql);
	}
	else header('location: ../daftar.php');
	$conn->close();
}