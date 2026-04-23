import { HTMLAttributes } from 'react';

export default function AppLogoIcon({ className, ...props }: HTMLAttributes<HTMLImageElement>) {
    return (
        <img
            src="/branding/logo.png"
            alt="University of Perpetual Help System"
            className={className}
            {...props}
        />
    );
}
