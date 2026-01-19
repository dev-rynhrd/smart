import {
    LayoutDashboard,
    Package,
    FileText,
    BarChart3,
    Settings,
    Users,
    Bell,
    HelpCircle
} from 'lucide-vue-next';

export interface NavItem {
    title: string;
    href: string;
    icon: any;
    badge?: string | number;
    children?: NavItem[];
}

export interface NavSection {
    title?: string;
    items: NavItem[];
}

export const mainNavigation: NavSection[] = [
    {
        title: 'Main',
        items: [
            {
                title: 'Dashboard',
                href: '/smart/dashboard',
                icon: LayoutDashboard,
            },
        ],
    },
    {
        title: 'Inventory',
        items: [
            {
                title: 'Stock Items',
                href: '/smart/inventory',
                icon: Package,
            },
            {
                title: 'Requests',
                href: '/smart/requests',
                icon: FileText,
                badge: 'New',
            },
        ],
    },
    {
        title: 'Reports',
        items: [
            {
                title: 'Analytics',
                href: '/smart/analytics',
                icon: BarChart3,
            },
        ],
    },
    {
        title: 'Administration',
        items: [
            {
                title: 'Users',
                href: '/smart/users',
                icon: Users,
            },
            {
                title: 'Settings',
                href: '/smart/settings',
                icon: Settings,
            },
        ],
    },
];

export const quickActions = [
    {
        title: 'Notifications',
        icon: Bell,
        badge: 3,
    },
    {
        title: 'Help',
        icon: HelpCircle,
    },
];

// Navigation for regular users (non-admin)
export const userNavigation: NavSection[] = [
    {
        title: 'Main',
        items: [
            {
                title: 'Dashboard',
                href: '/smart/user/dashboard',
                icon: LayoutDashboard,
            },
        ],
    },
    {
        title: 'My Items',
        items: [
            {
                title: 'My Requests',
                href: '/smart/requests',
                icon: FileText,
            },
        ],
    },
];
