<?php
include 'header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Welcome to <span>ByteFury</span></h1>
            <p>Ignite your coding journey with expert-led courses and powerful CMS tools designed for modern developers.</p>
            <a href="courses.php" class="cta-btn">Start Learning Now</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-list">
            <div class="feature-item">
                <i class="icon icon-lightning"></i>
                <h3>Blazing Fast Learning</h3>
                <p>Dive into rapid, focused lessons designed to make complex concepts clear and practical.</p>
            </div>
            <div class="feature-item">
                <i class="icon icon-challenge"></i>
                <h3>Real-World Challenges</h3>
                <p>Test your skills with coding challenges crafted to boost your proficiency.</p>
            </div>
            <div class="feature-item">
                <i class="icon icon-community"></i>
                <h3>Dynamic Community</h3>
                <p>Join a passionate community of developers, collaborate, and grow together.</p>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
        <h2>Ready to start learning?</h2>
        <p>Explore our courses, develop new skills, and join a vibrant community of tech enthusiasts.</p>
        <a href="signup.php" class="cta-btn">Join ByteFury Today</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

<style>
    /* Hero Section */
.hero-section {
    display: flex;
    align-items: center;
    padding: 60px;
    background: linear-gradient(135deg, #005f99, #007bff);
    color: #fff;
}

.hero-content {
    max-width: 50%;
}

.hero-content h1 {
    font-size: 48px;
    font-weight: bold;
}

.hero-content span {
    color: #ffdd57;
}

.hero-content p {
    font-size: 20px;
    margin-top: 10px;
}

.cta-btn {
    display: inline-block;
    padding: 10px 30px;
    background-color: #ffdd57;
    color: #333;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.cta-btn:hover {
    background-color: #e6c148;
}

/* Features Section */
.features-section {
    padding: 60px 20px;
    text-align: center;
    background-color: #f9f9f9;
}

.features-list {
    display: flex;
    justify-content: center;
    gap: 30px;
}

.feature-item {
    width: 250px;
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-item h3 {
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
}


/* CTA Section */
.cta-section {
    padding: 40px;
    background-color: #007bff;
    text-align: center;
    color: #fff;
}


.cta-section h2 {
    font-size: 32px;
    font-weight: bold;
}

.cta-section p {
    font-size: 18px;
    margin-top: 10px;
}

</style>