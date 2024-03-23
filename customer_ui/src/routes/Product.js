import Hero from "../components/Hero";
import Navbar from "../components/Navbar";
import ProductImg from "../Assets/photo1.png";
import HelmetImg from "../Assets/helmet.png";

function Product (){
    return(
        <>
        <Navbar/>
        <Hero
        cName="hero-mid"
        heroImg={ProductImg}
        helmetimg={HelmetImg}
        title2="Our Product"
        title3="SAFEx ensures a new era for the construction field."
        title4="Web Camera"
        title5="Gas Leak Detection"
        title6="Money & Work hours"
        pClass1="p-class-1"
        pClass2="p-class-2"
        pClass3="p-class-3"
        pClass4="p-class-4"
        showP1={true}
        showP2={true}
        showP3={true}
        showP4={true}
        />
        </>
    )
}

export default Product;
