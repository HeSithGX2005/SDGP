import Hero from "../components/Hero";
import Navbar from "../components/Navbar";

function Home (){
    return(
        <>
        <Navbar/>
        <Hero
        cName="hero"
        heroImg="https://i.pinimg.com/736x/d7/c9/c9/d7c9c9532efbbbe080814be8c132aad5.jpg"
        title="“Empower Safety, Enhance Connectivity, Elevate Lifestyle”"
        btnName="Explore"
        url="/ourProduct"
        btnClass="show"
        />
        </>
    )
}

export default Home;

