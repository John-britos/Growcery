import{ useState } from 'react';    
import { Product } from '@/types';
import { Link } from '@inertiajs/react';
import CurrencyFormatter from '../core/CurrencyFormatter';



export default function ProductItem({product}: { product: Product }) {
    return (
        <div className="card w-64 h-auto bg-base-100 drop-shadow-[0_5px_10px_rgba(34,197,94,1)] rounded-lg overflow-hidden p-4"> 
            <Link href={route('product.show', { slug: product.slug })}>
                <figure>
                    <img
                        src={product.image}
                        alt={product.title || 'Product Image'}
                        className="aspect-square object-cover"
                    />
                </figure>
            </Link>
            <div className="card-body">
                <h2 className="card-title">{product.title}</h2>
                <p>
                    Vendor: <Link href="/" className="hover:underline">{product.user.name}</Link>&nbsp;&nbsp;
                    Department: <Link href="/" className='hover:underline'>{product.department.name}</Link>
                </p>
            </div>
            <div className ="card-actions items-center justify-between mt-3">
                <button className='btn btn-success'>Add to cart</button>
                <span className="text-2xl">
                    <CurrencyFormatter amount={product.price}/>

                </span>

            </div>
        </div>
    );
}