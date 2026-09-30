@extends('layouts.app')

@section('title', 'Study MBBS in Europe | EuroMedStudy – Affordable Medical Education')
@section('description', 'Study MBBS in Europe at WHO & NMC recognized universities. Affordable fees, English medium programs in Germany, Poland, Hungary, Czech Republic, Romania & Latvia.')

@section('content')

  {{-- Flash Success --}}
  @if(session('success'))
  <div id="flash-success" style="position:fixed;top:90px;right:24px;z-index:9999;background:#1a56e8;color:#fff;padding:14px 24px;border-radius:12px;box-shadow:0 8px 32px rgba(26,86,232,0.3);font-weight:600;font-size:0.95rem;max-width:360px;">
    🎉 {{ session('success') }}
  </div>
  <script>setTimeout(()=>{const el=document.getElementById('flash-success');if(el)el.remove();},5000);</script>
  @endif

  <!-- ===== NAVBAR ===== -->
  <nav class="navbar" id="navbar">
    <div class="nav-container">
      <a href="{{ route('home') }}" class="nav-logo">
        <span class="logo-icon">⚕</span>
        <span>EuroMedStudy</span>
      </a>
      <ul class="nav-links" id="navLinks">
        <li><a href="#why-europe" class="nav-link">Why Europe</a></li>
        <li><a href="#countries" class="nav-link">Countries</a></li>
        <li><a href="#universities" class="nav-link">Universities</a></li>
        <li><a href="#process" class="nav-link">Process</a></li>
        <li><a href="#fees" class="nav-link">Fees</a></li>
        <li><a href="#testimonials" class="nav-link">Testimonials</a></li>
        <li><a href="#contact" class="nav-link nav-cta">Apply Now</a></li>
      </ul>
      <button class="hamburger" id="hamburger" aria-label="Toggle Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  <!-- ===== HERO ===== -->
  <section class="hero" id="home">
    <div class="hero-bg">
      <img src="{{ asset('assets/hero.jpg') }}" alt="European Medical University Campus" class="hero-img" />
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
      <div class="hero-badge animate-fade-up">🎓 Trusted by 10,000+ Students</div>
      <h1 class="hero-title animate-fade-up">
        Study <span class="gradient-text">MBBS</span> in Europe
      </h1>
      <p class="hero-subtitle animate-fade-up">
        Earn a globally recognized medical degree at world-class European universities.<br/>
        English-taught programs · Affordable tuition · WHO & MCI recognized
      </p>
      <div class="hero-stats animate-fade-up">
        <div class="stat-item"><span class="stat-num">50+</span><span class="stat-label">Universities</span></div>
        <div class="stat-divider"></div>
        <div class="stat-item"><span class="stat-num">6</span><span class="stat-label">Countries</span></div>
        <div class="stat-divider"></div>
        <div class="stat-item"><span class="stat-num">€3K</span><span class="stat-label">Avg. Annual Fee</span></div>
        <div class="stat-divider"></div>
        <div class="stat-item"><span class="stat-num">6yr</span><span class="stat-label">Duration</span></div>
      </div>
      <div class="hero-cta animate-fade-up">
        <a href="#contact" class="btn btn-primary" id="hero-apply-btn">Apply for Free Counselling</a>
        <a href="#why-europe" class="btn btn-outline" id="hero-learn-btn">Explore Programs</a>
      </div>
    </div>
    <div class="hero-scroll-indicator"><div class="scroll-dot"></div></div>
  </section>

  <!-- ===== MARQUEE ===== -->
  <div class="marquee-strip">
    <div class="marquee-track">
      <span>🏆 WHO Recognized</span><span>·</span><span>📜 NMC / MCI Approved</span><span>·</span>
      <span>🌍 EU Member Universities</span><span>·</span><span>🎓 English Medium Programs</span><span>·</span>
      <span>💰 No Donation / Capitation Fee</span><span>·</span><span>🏥 Clinical Training in Top Hospitals</span><span>·</span>
      <span>🏆 WHO Recognized</span><span>·</span><span>📜 NMC / MCI Approved</span><span>·</span>
      <span>🌍 EU Member Universities</span><span>·</span><span>🎓 English Medium Programs</span><span>·</span>
      <span>💰 No Donation / Capitation Fee</span><span>·</span><span>🏥 Clinical Training in Top Hospitals</span>
    </div>
  </div>

  <!-- ===== WHY EUROPE ===== -->
  <section class="section why-europe" id="why-europe">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Why Choose Europe</span>
        <h2 class="section-title">The Smart Choice for <span class="gradient-text">Medical Aspirants</span></h2>
        <p class="section-desc">European medical universities offer world-class education at a fraction of the cost compared to other countries.</p>
      </div>
      <div class="why-grid">
        <div class="why-card">
          <div class="why-icon">🏛️</div>
          <h3>Globally Recognized Degree</h3>
          <p>Degrees recognized by WHO, NMC, ECFMG, and medical councils worldwide. Practice medicine anywhere in the world.</p>
        </div>
        <div class="why-card">
          <div class="why-icon">💸</div>
          <h3>Affordable Education</h3>
          <p>Annual tuition fees ranging from €3,000–€8,000. No hidden donation or capitation fees. Scholarships available.</p>
        </div>
        <div class="why-card">
          <div class="why-icon">🇬🇧</div>
          <h3>English Medium Programs</h3>
          <p>All programs taught entirely in English. No need to learn a foreign language to pursue your medical degree.</p>
        </div>
        <div class="why-card">
          <div class="why-icon">🏥</div>
          <h3>Advanced Clinical Training</h3>
          <p>Hands-on clinical experience in state-of-the-art university hospitals with access to thousands of real patients.</p>
        </div>
        <div class="why-card">
          <div class="why-icon">🔬</div>
          <h3>Research Opportunities</h3>
          <p>Access to cutting-edge research facilities, labs, and collaboration with Europe's top medical research centers.</p>
        </div>
        <div class="why-card">
          <div class="why-icon">🛡️</div>
          <h3>Safe & Student-Friendly</h3>
          <p>Welcoming student communities, safe living conditions, and affordable cost of living across European cities.</p>
        </div>
      </div>

      <div class="about-row">
        <div class="about-image-wrap">
          <img src="{{ asset('assets/students.jpg') }}" alt="International medical students studying in European university" class="about-img" />
          <div class="about-badge-float">
            <span class="badge-num">10,000+</span>
            <span class="badge-text">Students Successfully Placed</span>
          </div>
        </div>
        <div class="about-text">
          <span class="section-tag">Our Expertise</span>
          <h2 class="section-title">Your Gateway to a <span class="gradient-text">World-Class</span> Medical Career</h2>
          <p>EuroMedStudy has been helping aspiring doctors from South Asia, Africa, and beyond to achieve their dream of studying medicine in Europe. With over a decade of experience, we provide end-to-end guidance.</p>
          <ul class="about-list">
            <li>✅ Free counselling and university selection</li>
            <li>✅ Visa assistance and documentation support</li>
            <li>✅ Pre-departure orientation</li>
            <li>✅ Accommodation and arrival support</li>
            <li>✅ On-campus student representatives</li>
          </ul>
          <a href="#contact" class="btn btn-primary">Start Your Journey</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TOP COUNTRIES ===== -->
  <section class="section countries-section" id="countries">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Destinations</span>
        <h2 class="section-title">Top Countries to Study <span class="gradient-text">MBBS in Europe</span></h2>
        <p class="section-desc">Choose from six premier European destinations, each offering excellent medical education at affordable costs.</p>
      </div>
      <div class="countries-grid">
        @foreach($countries as $country)
        <div class="country-card">
          <div class="country-flag">{{ $country['flag'] }}</div>
          <div class="country-info">
            <h3>{{ $country['name'] }}</h3>
            <p class="country-tagline">{{ $country['tagline'] }}</p>
            <ul class="country-facts">
              <li><span>Duration:</span> {{ $country['duration'] }}</li>
              <li><span>Language:</span> {{ $country['language'] }}</li>
              <li><span>Fees:</span> {{ $country['fees'] }}</li>
              <li><span>Intake:</span> {{ $country['intake'] }}</li>
            </ul>
          </div>
          <div class="country-overlay">
            <p>{{ $country['desc'] }}</p>
            <a href="#contact" class="btn btn-sm">Enquire Now</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ===== ADMISSION PROCESS ===== -->
  <section class="section process-section" id="process">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">How It Works</span>
        <h2 class="section-title">Simple <span class="gradient-text">Admission Process</span></h2>
        <p class="section-desc">We make the process of studying medicine in Europe simple, transparent and stress-free.</p>
      </div>
      <div class="process-timeline">
        @php
        $steps = [
          ['num'=>'01','icon'=>'💬','title'=>'Free Counselling','desc'=>'Connect with our expert advisors for a free one-on-one session to discuss your goals, eligibility, and best university options.'],
          ['num'=>'02','icon'=>'📋','title'=>'Document Preparation','desc'=>'We help you prepare all required documents: transcripts, English proficiency, passport, medical certificates, and more.'],
          ['num'=>'03','icon'=>'🎓','title'=>'University Application','desc'=>'Our team submits your application to shortlisted universities and ensures all requirements are met for admission.'],
          ['num'=>'04','icon'=>'📩','title'=>'Receive Offer Letter','desc'=>'Once accepted, you\'ll receive an official offer letter from the university within 4–8 weeks of application.'],
          ['num'=>'05','icon'=>'✈️','title'=>'Visa & Travel','desc'=>'We assist with student visa application, travel insurance, accommodation booking, and pre-departure guidance.'],
          ['num'=>'06','icon'=>'🏥','title'=>'Begin Your MBBS','desc'=>'Arrive in Europe, complete enrollment, and start your journey to becoming a doctor. Our local teams support you on-ground.'],
        ];
        @endphp
        @foreach($steps as $step)
        <div class="process-step">
          <div class="step-number">{{ $step['num'] }}</div>
          <div class="step-content">
            <div class="step-icon">{{ $step['icon'] }}</div>
            <h3>{{ $step['title'] }}</h3>
            <p>{{ $step['desc'] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ===== ELIGIBILITY ===== -->
  <section class="section eligibility-section">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Requirements</span>
        <h2 class="section-title">Eligibility <span class="gradient-text">Criteria</span></h2>
        <p class="section-desc">Check if you qualify for MBBS admission in European medical universities.</p>
      </div>
      <div class="eligibility-grid">
        <div class="elig-card">
          <div class="elig-icon">🎓</div>
          <h3>Academic Qualification</h3>
          <ul><li>Completed 10+2 / A-Levels / High School</li><li>Physics, Chemistry, Biology as main subjects</li><li>Minimum 50% aggregate marks (60% for general)</li></ul>
        </div>
        <div class="elig-card">
          <div class="elig-icon">📝</div>
          <h3>Entrance Exam</h3>
          <ul><li>NEET qualification required for Indian students</li><li>Some countries require their own entrance tests</li><li>No separate test required for many EU universities</li></ul>
        </div>
        <div class="elig-card">
          <div class="elig-icon">🗣️</div>
          <h3>Language Proficiency</h3>
          <ul><li>IELTS 6.0+ or TOEFL 72+ for English programs</li><li>Many universities accept high school English proof</li><li>No language test for mother-tongue English speakers</li></ul>
        </div>
        <div class="elig-card">
          <div class="elig-icon">🎂</div>
          <h3>Age Requirement</h3>
          <ul><li>Minimum age: 17 years at time of admission</li><li>Maximum age: 25 years (varies by country)</li><li>No upper age limit in some European countries</li></ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TOP UNIVERSITIES ===== -->
  <section class="section universities-section" id="universities">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Top Institutions</span>
        <h2 class="section-title">Premier <span class="gradient-text">Medical Universities</span></h2>
        <p class="section-desc">Partner with the best medical universities in Europe that are globally recognized and NMC/WHO approved.</p>
      </div>
      <div class="universities-grid">
        @foreach($universities as $uni)
        <div class="uni-card">
          <div class="uni-rank">{{ $uni['rank'] }}</div>
          <div class="uni-flag">{{ $uni['flag'] }}</div>
          <h3>{{ $uni['name'] }}</h3>
          <p class="uni-country">{{ $uni['city'] }}</p>
          <div class="uni-tags">
            @foreach($uni['tags'] as $tag)<span>{{ $tag }}</span>@endforeach
          </div>
          <div class="uni-fee">{{ $uni['fee'] }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ===== FEES TABLE ===== -->
  <section class="section fees-section" id="fees">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Cost Comparison</span>
        <h2 class="section-title">Fees & Cost of <span class="gradient-text">Living Overview</span></h2>
        <p class="section-desc">Compare tuition fees and living costs across top MBBS destinations in Europe.</p>
      </div>
      <div class="fees-table-wrap">
        <table class="fees-table">
          <thead>
            <tr>
              <th>Country</th>
              <th>Tuition Fee / Year</th>
              <th>Living Cost / Month</th>
              <th>Total 6 Yr Cost</th>
              <th>NMC</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fees as $row)
            <tr class="{{ !empty($row['highlight']) ? 'row-highlight' : '' }}">
              <td><span class="flag-sm">{{ $row['flag'] }}</span> {{ $row['country'] }}</td>
              <td>{{ $row['tuition'] }}</td>
              <td>{{ $row['living'] }}</td>
              <td>{{ $row['total'] }}</td>
              <td><span class="badge-yes">✓</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <p class="fees-note">* All figures are approximate. Fees may vary by university and year. Contact us for exact current fees.</p>
    </div>
  </section>

  <!-- ===== TESTIMONIALS ===== -->
  <section class="section testimonials-section" id="testimonials">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">Success Stories</span>
        <h2 class="section-title">What Our <span class="gradient-text">Students Say</span></h2>
        <p class="section-desc">Real experiences from students who are now pursuing their medical dreams in Europe.</p>
      </div>
      <div class="testimonials-carousel">
        <div class="testimonials-track" id="testimonialsTrack">
          @foreach($testimonials as $t)
          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="testimonial-text">"{{ $t['text'] }}"</p>
            <div class="testimonial-author">
              <div class="author-avatar">{{ $t['initials'] }}</div>
              <div class="author-info">
                <strong>{{ $t['name'] }}</strong>
                <span>{{ $t['info'] }}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="carousel-controls">
          <button class="carousel-btn" id="prevBtn" aria-label="Previous">&#8592;</button>
          <div class="carousel-dots" id="carouselDots"></div>
          <button class="carousel-btn" id="nextBtn" aria-label="Next">&#8594;</button>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== GRADUATE SHOWCASE ===== -->
  <section class="section graduate-section">
    <div class="container">
      <div class="graduate-row">
        <div class="graduate-text">
          <span class="section-tag">Success Stories</span>
          <h2 class="section-title">From <span class="gradient-text">Student to Doctor</span></h2>
          <p>Thousands of students have successfully completed their MBBS from top European universities through EuroMedStudy and are now practicing doctors around the world.</p>
          <div class="grad-stats-row">
            <div class="grad-stat"><span class="grad-stat-num">10,000+</span><span>Students Enrolled</span></div>
            <div class="grad-stat"><span class="grad-stat-num">95%</span><span>Visa Success Rate</span></div>
            <div class="grad-stat"><span class="grad-stat-num">50+</span><span>Partner Universities</span></div>
          </div>
          <a href="#contact" class="btn btn-primary">Join Our Alumni Network</a>
        </div>
        <div class="graduate-image-wrap">
          <img src="{{ asset('assets/graduate.jpg') }}" alt="Happy MBBS graduate doctor from European university" class="graduate-img" />
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FAQ ===== -->
  <section class="section faq-section" id="faq">
    <div class="container">
      <div class="section-header">
        <span class="section-tag">FAQ</span>
        <h2 class="section-title">Frequently Asked <span class="gradient-text">Questions</span></h2>
        <p class="section-desc">Everything you need to know about studying MBBS in Europe.</p>
      </div>
      <div class="faq-list">
        @foreach($faqs as $i => $faq)
        <div class="faq-item" id="faq-{{ $i+1 }}">
          <button class="faq-question" aria-expanded="false">
            {{ $faq['q'] }}<span class="faq-icon">+</span>
          </button>
          <div class="faq-answer"><p>{{ $faq['a'] }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ===== CONTACT / APPLY ===== -->
  <section class="section contact-section" id="contact">
    <div class="container">
      <div class="contact-wrapper">
        <div class="contact-info">
          <span class="section-tag">Get In Touch</span>
          <h2 class="section-title">Start Your <span class="gradient-text">Medical Journey</span> Today</h2>
          <p>Our expert counsellors are ready to help you take the first step towards your MBBS in Europe. Free consultation, no obligations.</p>
          <div class="contact-details">
            <div class="contact-item">
              <span class="contact-icon">📞</span>
              <div><strong>Call / WhatsApp</strong><span>+91 98765 43210</span></div>
            </div>
            <div class="contact-item">
              <span class="contact-icon">📧</span>
              <div><strong>Email Us</strong><span>info@euromedStudy.com</span></div>
            </div>
            <div class="contact-item">
              <span class="contact-icon">📍</span>
              <div><strong>Office</strong><span>New Delhi | Mumbai | Kathmandu</span></div>
            </div>
            <div class="contact-item">
              <span class="contact-icon">🕐</span>
              <div><strong>Working Hours</strong><span>Mon–Sat: 9 AM – 7 PM IST</span></div>
            </div>
          </div>
        </div>
        <div class="contact-form-wrap">
          <form class="contact-form" id="contactForm" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <h3>Book a Free Counselling Session</h3>

            @if($errors->any())
            <div class="form-errors">
              @foreach($errors->all() as $error)
              <p>⚠ {{ $error }}</p>
              @endforeach
            </div>
            @endif

            <div class="form-row">
              <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" id="full_name" name="full_name" placeholder="Your Full Name" value="{{ old('full_name') }}" required />
              </div>
              <div class="form-group">
                <label for="phone">Phone / WhatsApp *</label>
                <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required />
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" name="email" placeholder="you@email.com" value="{{ old('email') }}" required />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="country">Preferred Country</label>
                <select id="country" name="country">
                  <option value="">Select Country</option>
                  <option value="germany"  {{ old('country')=='germany'?'selected':'' }}>Germany</option>
                  <option value="poland"   {{ old('country')=='poland'?'selected':'' }}>Poland</option>
                  <option value="hungary"  {{ old('country')=='hungary'?'selected':'' }}>Hungary</option>
                  <option value="czech"    {{ old('country')=='czech'?'selected':'' }}>Czech Republic</option>
                  <option value="romania"  {{ old('country')=='romania'?'selected':'' }}>Romania</option>
                  <option value="latvia"   {{ old('country')=='latvia'?'selected':'' }}>Latvia</option>
                  <option value="undecided"{{ old('country')=='undecided'?'selected':'' }}>Help me decide</option>
                </select>
              </div>
              <div class="form-group">
                <label for="qualification">Current Qualification</label>
                <select id="qualification" name="qualification">
                  <option value="">Select Status</option>
                  <option value="12th"         {{ old('qualification')=='12th'?'selected':'' }}>Appearing 12th</option>
                  <option value="12th-passed"  {{ old('qualification')=='12th-passed'?'selected':'' }}>12th Passed</option>
                  <option value="neet-qualified"{{ old('qualification')=='neet-qualified'?'selected':'' }}>NEET Qualified</option>
                  <option value="other"        {{ old('qualification')=='other'?'selected':'' }}>Other</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="message">Message (Optional)</label>
              <textarea id="message" name="message" rows="3" placeholder="Any specific questions or requirements...">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-full" id="submitForm">
              Submit Free Application →
            </button>
            <p class="form-privacy">🔒 Your information is 100% safe and will never be shared.</p>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="{{ route('home') }}" class="nav-logo"><span class="logo-icon">⚕</span><span>EuroMedStudy</span></a>
          <p>Helping aspiring doctors achieve their dream of studying MBBS in Europe since 2012.</p>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="Facebook">f</a>
            <a href="#" class="social-link" aria-label="Instagram">in</a>
            <a href="#" class="social-link" aria-label="YouTube">▶</a>
            <a href="#" class="social-link" aria-label="WhatsApp">W</a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#why-europe">Why Europe</a></li>
            <li><a href="#countries">Countries</a></li>
            <li><a href="#universities">Universities</a></li>
            <li><a href="#process">Admission Process</a></li>
            <li><a href="#fees">Fees</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Top Countries</h4>
          <ul>
            <li><a href="#countries">MBBS in Germany</a></li>
            <li><a href="#countries">MBBS in Poland</a></li>
            <li><a href="#countries">MBBS in Hungary</a></li>
            <li><a href="#countries">MBBS in Czech Republic</a></li>
            <li><a href="#countries">MBBS in Romania</a></li>
            <li><a href="#countries">MBBS in Latvia</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Top Universities</h4>
          <ul>
            <li><a href="#universities">Jagiellonian University</a></li>
            <li><a href="#universities">Semmelweis University</a></li>
            <li><a href="#universities">Charles University</a></li>
            <li><a href="#universities">Wroclaw Medical Univ.</a></li>
            <li><a href="#universities">Riga Stradiņš Univ.</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© {{ date('Y') }} EuroMedStudy. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        <p class="footer-disclaimer">This website is for informational purposes. Fees and eligibility criteria are subject to change.</p>
      </div>
    </div>
  </footer>

  <!-- BACK TO TOP -->
  <button class="back-to-top" id="backToTop" aria-label="Back to top">↑</button>

  <!-- SUCCESS MODAL (for AJAX submit) -->
  <div class="modal-overlay" id="successModal">
    <div class="modal">
      <div class="modal-icon">🎉</div>
      <h3>Application Submitted!</h3>
      <p>Thank you! Our expert counsellor will contact you within 24 hours to discuss your MBBS journey in Europe.</p>
      <button class="btn btn-primary" id="closeModal">Great, Thank You!</button>
    </div>
  </div>

@endsection
