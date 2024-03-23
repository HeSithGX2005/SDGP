import { Component } from "react";
import "./NavbarStyle.css";
import { MenuItems } from "./MenuItems";
import { Link } from "react-router-dom";

class Navbar extends Component{
    render(){
        return(
            <nav className="NavbarItems">
                <Link to="/" className="navbar-logo">
                    SafeX
                </Link>

                <ul className="nav-menu">
                    {MenuItems.map((item, index) => {
                        return(
                         <li key={index}>
                            <Link  className={item.cName}
                            to={item.url}>
                            {item.title}
                            </Link>
                        </li>   
                        )
                    })}
                    <button>Login</button>
                </ul>
            </nav>
        )
    }
}

export default Navbar;