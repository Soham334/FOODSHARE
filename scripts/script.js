// Wait for DOM to be fully loaded
document.addEventListener("DOMContentLoaded", () => {
    // Mobile Navigation Toggle
    const mobileToggle = document.getElementById("mobile-toggle")
    const navbar = document.getElementById("navbar")
  
    mobileToggle.addEventListener("click", function () {
      this.classList.toggle("active")
      navbar.classList.toggle("active")
    })
  
    // Close mobile menu when clicking on a nav link
    const navLinks = document.querySelectorAll("nav ul li a")
    navLinks.forEach((link) => {
      link.addEventListener("click", () => {
        mobileToggle.classList.remove("active")
        navbar.classList.remove("active")
      })
    })
  
    // Sticky Header
    const header = document.querySelector("header")
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        header.classList.add("scrolled")
      } else {
        header.classList.remove("scrolled")
      }
    })
  
    // Active Navigation Link
    const sections = document.querySelectorAll("section")
  
    window.addEventListener("scroll", () => {
      let current = ""
  
      sections.forEach((section) => {
        const sectionTop = section.offsetTop
        const sectionHeight = section.clientHeight
  
        if (pageYOffset >= sectionTop - 200) {
          current = section.getAttribute("id")
        }
      })
  
      navLinks.forEach((link) => {
        link.classList.remove("active")
        if (link.getAttribute("href") === `#${current}`) {
          link.classList.add("active")
        }
      })
    })
  
    // Back to Top Button
    const backToTopBtn = document.getElementById("back-to-top")
  
    window.addEventListener("scroll", () => {
      if (window.scrollY > 300) {
        backToTopBtn.classList.add("active")
      } else {
        backToTopBtn.classList.remove("active")
      }
    })
  
    backToTopBtn.addEventListener("click", (e) => {
      e.preventDefault()
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      })
    })
  
    // Donation Tabs
    const tabBtns = document.querySelectorAll(".tab-btn")
    const tabPanes = document.querySelectorAll(".tab-pane")
  
    tabBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        // Remove active class from all buttons and panes
        tabBtns.forEach((btn) => btn.classList.remove("active"))
        tabPanes.forEach((pane) => pane.classList.remove("active"))
  
        // Add active class to clicked button
        this.classList.add("active")
  
        // Show corresponding tab pane
        const tabId = this.getAttribute("data-tab") + "-tab"
        document.getElementById(tabId).classList.add("active")
      })
    })
  
    // Donation Amount Buttons
    const amountBtns = document.querySelectorAll(".amount-btn")
    const customAmountInput = document.getElementById("custom-amount")
    const amountInput = document.getElementById("amount")

    if (amountBtns.length > 0 && amountInput) {
      amountBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          amountBtns.forEach((btn) => btn.classList.remove("active"))
          this.classList.add("active")
    
          if (this.getAttribute("data-amount") === "custom") {
            amountInput.classList.remove("hidden")
            amountInput.focus()
            amountInput.value = ""
          } else {
            amountInput.classList.add("hidden")
            amountInput.value = this.getAttribute("data-amount")
          }
        })
      })
    }
  
    // Testimonial Slider
    const testimonials = document.querySelectorAll(".testimonial")
    const dots = document.querySelectorAll(".dot")
    const prevBtn = document.getElementById("prev-testimonial")
    const nextBtn = document.getElementById("next-testimonial")
    let currentTestimonial = 0
  
    function showTestimonial(index) {
      testimonials.forEach((testimonial) => testimonial.classList.remove("active"))
      dots.forEach((dot) => dot.classList.remove("active"))
  
      testimonials[index].classList.add("active")
      dots[index].classList.add("active")
      currentTestimonial = index
    }
  
    // Next testimonial
    nextBtn.addEventListener("click", () => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length
      showTestimonial(currentTestimonial)
    })
  
    // Previous testimonial
    prevBtn.addEventListener("click", () => {
      currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length
      showTestimonial(currentTestimonial)
    })
  
    // Dot navigation
    dots.forEach((dot) => {
      dot.addEventListener("click", function () {
        const index = Number.parseInt(this.getAttribute("data-index"))
        showTestimonial(index)
      })
    })
  
    // Auto-rotate testimonials
    setInterval(() => {
      currentTestimonial = (currentTestimonial + 1) % testimonials.length
      showTestimonial(currentTestimonial)
    }, 5000)
  
    // Form Submissions
    const forms = document.querySelectorAll("form")
    const modal = document.getElementById("success-modal")
    const closeModal = document.querySelector(".close-modal")
    const modalBtn = document.querySelector(".modal-btn")
  
    forms.forEach((form) => {
      form.addEventListener("submit", function(e) {
        e.preventDefault()
        
        console.log("Form submitted:", this.id);
        
        // Get the form ID to determine which PHP endpoint to use
        const formId = this.getAttribute("id");
        let phpEndpoint = "";
        
        // Set the appropriate PHP endpoint based on form ID
        if (formId === "contact-form") {
          phpEndpoint = "process_message.php";
        } else if (formId === "donation-form") {
          phpEndpoint = "process_donation.php";
        } else if (formId === "food-donation-form") {
          phpEndpoint = "process_food_donation.php";
        } else if (formId === "volunteer-form") {
          phpEndpoint = "process_volunteer.php";
        } else {
          console.error("Unknown form ID:", formId);
          return;
        }
        
        // Create FormData object from the form
        const formData = new FormData(this);
        
        // Log form data for debugging
        for (let pair of formData.entries()) {
          console.log(pair[0] + ': ' + pair[1]);
        }
        
        // Send form data to server using fetch API
        fetch(phpEndpoint, {
          method: "POST",
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(data => {
          console.log("Server response:", data);
          // Show success modal
          modal.classList.add("active");
          // Reset form
          this.reset();
        })
        .catch(error => {
          console.error("Error submitting form:", error);
          alert("There was an error submitting the form. Please try again.");
        });
      })
    })
  
    // Close modal
    closeModal.addEventListener("click", () => {
      modal.classList.remove("active")
    })
  
    modalBtn.addEventListener("click", () => {
      modal.classList.remove("active")
    })
  
    // Close modal when clicking outside
    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.remove("active")
      }
    })
  
    // Animate stats counter
    const statNumbers = document.querySelectorAll(".stat-number")
  
    function animateStats() {
      statNumbers.forEach((stat) => {
        const target = Number.parseInt(stat.getAttribute("data-count"))
        const duration = 2000 // 2 seconds
        const step = target / (duration / 16) // 16ms per frame (approx 60fps)
        let current = 0
  
        const timer = setInterval(() => {
          current += step
  
          if (current >= target) {
            stat.textContent = target.toLocaleString()
            clearInterval(timer)
          } else {
            stat.textContent = Math.floor(current).toLocaleString()
          }
        }, 16)
      })
    }
  
    // Trigger stats animation when in viewport
    const heroSection = document.querySelector(".hero")
  
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateStats()
            observer.unobserve(entry.target)
          }
        })
      },
      { threshold: 0.5 },
    )
  
    observer.observe(heroSection)
    
  })


