import 'package:flutter/material.dart';

const String baseURL = "http://64.227.68.242/api/";  // link to laravel website
const Map<String, String> headers = {"Content-type":"application/json"};

errorSnackBar(BuildContext context, String text) {
  ScaffoldMessenger.of(context).showSnackBar(
    SnackBar(
      backgroundColor: Colors.red,
      content: Text(text),
      duration: const Duration(seconds: 3),
    )
  );
}
