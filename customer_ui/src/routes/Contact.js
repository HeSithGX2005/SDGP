import React, { useState } from "react";
import { useNavigate } from "react-router-dom"; // Import useNavigate instead of useHistory
import emailjs from 'emailjs-com';
import Hero from "../components/Hero";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import ConImg from "../Assets/photo2.png";

function Contact() {
  const navigate = useNavigate(); // Initialize useNavigate hook

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: ""
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    emailjs.sendForm('service_dhr12ms', 'template_9h58k29', e.target, 'QqdMiJvptHw_3fA0K')
      .then((result) => {
        console.log(result.text);
        alert("Message sent successfully!");
        navigate('/'); // Use navigate function to navigate
      }, (error) => {
        console.log(error.text);
        alert("An error occurred, please try again later.");
      });

    setFormData({ name: "", email: "", message: "" });
  };

  return (
    <>
      <Navbar />
      <Hero
        cName="hero-last"
        heroImg={ConImg}
        helmetimg="hide"
        title="Contact Us"
        title6="Feel free to contact us and we will get back to you as soon as we can!"
        showP1={false}
        showP2={false}
        showP3={false}
      />
      <div className="contact-form-container">
        <form onSubmit={handleSubmit} className="contact-form">
          <div className="form-group">
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Enter your name"
              value={formData.name}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter your email"
              value={formData.email}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group">
            <textarea
              id="message"
              name="message"
              placeholder="Enter your message"
              value={formData.message}
              onChange={handleChange}
              required
            ></textarea>
          </div>
          <button className="submit" type="submit">
            Submit
          </button>
        </form>
      </div>
      <Footer />
    </>
  );
}

export default Contact;