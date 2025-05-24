# 🔐 Two-Factor Authentication (2FA) System – Implementation Report

## 📘 Project Overview

This project demonstrates the implementation of a **basic two-factor authentication (2FA)** system developed by the **Ashesi Saints** team as part of the **IS451: Information and Systems Security** course at Ashesi University.

The 2FA system enhances login security by requiring:
1. Valid username and password, **and**
2. A **One-Time PIN (OTP)** sent to the user’s email address.

The system was built using a structured **MVC architecture** and includes protections against common security vulnerabilities such as SQL injection and replay attacks.

## 🔑 Key Features

- Secure **user registration** with password hashing (`PASSWORD_BCRYPT`)
- Login system with **OTP verification via email**
- OTP expires after 2 minutes and is invalidated after use
- Basic client-side and server-side validation
- SQL injection protection with input sanitization
- TLS encryption used when sending OTPs via `PHPMailer`

## 🛠 Technologies Used

- PHP (MVC architecture)
- MySQL
- HTML/CSS/JavaScript
- PHPMailer (for email OTP delivery)

## 🎥 Watch the Demo

Watch the full project demonstration here:  
👉 [Click to Watch on Google Drive](https://drive.google.com/file/d/14sVafANNGCm_LKdKi3U7DExWMwv2coKL/view?usp=sharing)

## 💻 GitHub Repository

Explore the codebase here:  
🔗 [GitHub – ISS-A1](https://github.com/JimClifford/ISS-A1)

## 👥 Project Contributors

- Jim-Clifford Edward  
- Naa Lamiorkor Boye

## 🏫 Course Information

**Course**: IS451 – Information and Systems Security  
**Instructor**: [Dr. Name, if needed]  
**Institution**: Ashesi University  
**Date**: October 7, 2024

---

> This system shows how basic authentication can be strengthened through layered security, user input validation, and careful system design.
