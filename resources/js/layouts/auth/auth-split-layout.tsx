import { Link } from '@inertiajs/react';

interface AuthLayoutProps {
    children: React.ReactNode;
    title?: string;
    description?: string;
}

export default function AuthSplitLayout({ children, title, description }: AuthLayoutProps) {
    return (
        <div className="relative min-h-dvh grid lg:grid-cols-2">
            <div
                className="relative hidden flex-col justify-between overflow-hidden p-10 text-white lg:flex"
                style={{
                    backgroundImage: "url('/branding/bg.jpg')",
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                }}
            >
                <div className="absolute inset-0 bg-gradient-to-br from-sky-950/85 via-slate-950/80 to-slate-950/90" />

                <Link href="/" className="relative z-20 flex items-center gap-3">
                    <img
                        src="/branding/logo.png"
                        alt="University of Perpetual Help System"
                        className="size-10 rounded-full bg-white/90 p-0.5 shadow-lg ring-1 ring-white/30"
                    />
                    <span className="text-sm font-semibold tracking-wide uppercase">
                        University of Perpetual Help
                    </span>
                </Link>

                <div className="relative z-20 flex flex-col items-start gap-4">
                    <h1 className="text-4xl font-bold uppercase leading-tight tracking-wide text-white drop-shadow-[2px_2px_4px_rgba(0,0,0,0.6)] sm:text-5xl">
                        PAT Schedule Management
                    </h1>
                    <p className="max-w-md text-base text-white/80 drop-shadow">
                        Performing Arts Theater · Facility Request & Approval Workflow
                    </p>
                </div>

                <p className="relative z-20 text-xs text-white/50">
                    Character Building is Nation Building
                </p>
            </div>

            <div className="flex w-full items-center justify-center p-6 lg:p-12">
                <div className="mx-auto flex w-full max-w-sm flex-col gap-6">
                    <Link href="/" className="flex items-center justify-center gap-2 lg:hidden">
                        <img
                            src="/branding/logo.png"
                            alt="University of Perpetual Help System"
                            className="size-12 rounded-full bg-white p-0.5 shadow"
                        />
                        <span className="text-sm font-semibold uppercase">
                            PAT Schedule Management
                        </span>
                    </Link>

                    <div className="space-y-1.5 text-center">
                        <h2 className="text-2xl font-semibold uppercase tracking-wide">{title}</h2>
                        {description && (
                            <p className="text-muted-foreground text-sm">{description}</p>
                        )}
                    </div>

                    {children}
                </div>
            </div>
        </div>
    );
}
