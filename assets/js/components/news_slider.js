import 'slick-carousel';
import 'slick-carousel/slick/slick.less';
import 'slick-carousel/slick/slick-theme.less';
import '../../scss/components/_carousel.scss'

import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Slider from 'react-slick';
import ReactHtmlParser from 'react-html-parser';
import { useFetch } from '../inc/fetch';

const NewsSlider = (props) => {
    const [data, loading, hasError] = useFetch(props.endpoint);

    const settings = {
        arrows: true,
        autoplay: false,
        autoplaySpeed: 5000,
        dots: true,
    };

    if (hasError) {
        console.log('error');
    } else if (!loading) {
        return <div>Loading...</div>
    } else {
        const sliders = data.map((card, key) =>
            <Slide key={key} title={card.title} strapLine={card.strapLine}
                imagePath={card.imagePath} />
        );
    
        return (
            <Slider {...settings} className="news-slider">
                {sliders}
            </Slider>
        );
    }
}



class Slide extends Component {
    render() {
        return (
            <div className="slide news-slide">
                <img src={this.props.imagePath} className="d-block" alt={this.props.title}/>
                <div className="overlay">
                    <h2>{ReactHtmlParser(this.props.title)}</h2>
                    <p>{ReactHtmlParser(this.props.strapLine)}</p>
                </div>
            </div>
        );
    }
}

ReactDOM.render(<NewsSlider endpoint='api_carousel_articles' />, document.getElementById('news-slider'));